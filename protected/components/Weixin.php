<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-22
 * Time: 下午3:22
 */

class weixin {
    private $_Appid;
    private $_Appsecret;
    private $token='test';
    private $printXml="<xml>
    <ToUserName><![CDATA[(ToUserName)]]></ToUserName>
    <FromUserName><![CDATA[(FromUserName)]]></FromUserName>
    <CreateTime>(CreateTime)</CreateTime>
    <MsgType><![CDATA[(MsgType)]]></MsgType>
    (content)
    </xml>";
    private $textContent="<Content><![CDATA[(Content)]]></Content>";

    function __construct($Appid=null,$Appservret=null){
        $this->_Appid=$Appid;
        $this->_Appsecret=$Appservret;
    }


    public function checkSignature($token=null){
        if(!is_null($token)){
           $this->token=$token;
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = $this->token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }


    public function getXmlData(){
        $xmlDataStr=$GLOBALS['HTTP_RAW_POST_DATA'];
        return $xmlDataStr;
    }


    public function xmlStr2Array($xmlStr=null){
        if(is_null($xmlStr)){
            return false;
        }
        $xmlObject=simplexml_load_string($xmlStr,'SimpleXMLElement',LIBXML_NOCDATA);
        $xmlArray=json_decode(json_encode($xmlObject),true);
        return $xmlArray;
    }


    //$arr为用户发来的数据，$responseContent为返回给用户的数据，这里暂时只考虑text
    public function returnXmlData($arr,$responseContent){
        //本函数获得的arr中，touser，与from并没有交换位置，与接收到的一样
        //在本函数内部进行交换
        if(!is_array($arr)){
            return false;
        }else{
            //替换发出和接收微信
            list($arr['FromUserName'],$arr['ToUserName'])=array($arr['ToUserName'],$arr['FromUserName']);
            $arr['CreateTime']=time();
        }

        //目前只做了text
        switch($arr['MsgType']){
            case 'text':
                if(!is_string($responseContent)){
                    return false;
                }
                $arr['Content']=$responseContent;
                $res=str_replace('(content)',$this->textContent,$this->printXml);
                break;
            default:
                $res="return wrong";
        }
        //将变量赋值到反或的xml字符串中
        foreach($arr as $_k=>$_v){
            $res=str_replace('('.$_k.')',$_v,$res);
        }
        echo $res;
    }

    public static function getAccessToken($appid=null,$appsecret=null){
        if($appid == null || $appsecret ==null){
            return false;
        }
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $res=curl_exec($ch);
        curl_close($ch);
        $accessToken=json_decode($res,true);
        return $accessToken;
    }
    //从微信服务器端获得用户上传的图片
    public function getPic($openid=null,$access_token=null,$media_id=null){
        if(is_null($openid) || is_null($access_token) || is_null($media_id)){
            return "无法获得上传图片";
        }
        $url="http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id;
        $filename=PIC_SAVE_PATH.$openid.".jpg";
        $imgdata=$this->DownLoadPicContent($url);
        $this->setImgDataIntoFile($filename,$imgdata);
    }
    private function DownLoadPicContent($url){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_NOBODY,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $imgdata=curl_exec($ch);
        curl_close($ch);
        return $imgdata;
    }
    private function setImgDataIntoFile($filename,$imgdata){
        $local_file=fopen($filename,'w');
        if($local_file !== false){
            fwrite($local_file,$imgdata);
            fclose($local_file);
        }
    }
}
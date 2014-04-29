<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-15
 * Time: 下午5:59
 */
class WeixinController extends CWeixinController{
    public function actionIndex(){
        ini_set('session.gc_maxlifetime','60');
        $weixin = new Weixin($this->Appid,$this->Appsecret);
        $echostr=Mod::app()->request->getParam('echostr');
        if($weixin->checkSignature($this->token) && !is_null($echostr)){
             echo $echostr;
             exit;
        }

        $getXmlData=$weixin->getXmlData();
        $getArrData=$weixin->xmlStr2Array($getXmlData);
        $response='response';
        if(strtoupper($getArrData['Content']) == 'LOVE' && $this->createImgCache($getArrData['FromUserName'])){
            $response='请在'.$this->expireImgCache.'秒内发送图片';
        }elseif($getArrData['MsgType']=='image' && $this->judgeImgCache($getArrData['FromUserName'])){
            $getArrData['MsgType']='text';
            $response="<a href='".SERVER_URL."/auth/default/index?oid=".$getArrData['FromUserName']."'>点击</a>";
            $this->downLoadPic($getArrData['MediaId'],$getArrData['FromUserName']);

            //将用户的信息输入userdata数据库
            $this->inputUserData(array(
                'openid'=>$getArrData['FromUserName']
            ));
        }
        $weixin->returnXmlData($getArrData,$response);
    }


//一下三个对imgCache的操作，个人认为以后使用memcache来做比较好，因为本地开发没有使用海豹环境
//目前使用数据库来记录
    //判断是否超过图片缓存时间
    //返回true，表示下次如果输入的是img，是有效的
    private function judgeImgCache($fromusername){
        //清楚已经过时的缓存
        $this->delImgCache();
        $now=time();
        $validCreateTime=$now-$this->expireImgCache;
        $sql="select fromusername,createtime from {{imgcache}} where fromusername='".$fromusername."' order by createTime desc limit 1";
        $imgcache=Imgcache::model()->findBySql($sql);
        if($imgcache && $imgcache['createtime']>=$validCreateTime){
            return true;
        }else{
            return false;
        }

    }

    private function createImgCache($fromusername){
        if($this->judgeImgCache($fromusername)){
            $imgcache=Imgcache::model()->find("fromusername='".$fromusername."' order by id desc");
        }else{
            $imgcache=new Imgcache();
            $imgcache->fromusername=$fromusername;
        }
        $imgcache->createtime=time();
        if($imgcache->save()){
            return true;
        }else{
            return false;
        }
    }

    private function delImgCache(){
        $validCreateTime=time()-$this->expireImgCache;
        $imgcache=Imgcache::model();
        $imgcache->deleteAll('createtime<'.$validCreateTime);
    }

    //Weixin.php返回的是access_token的数据，本方法判断是否access过期，并返回access_token字符串
    private function getAccessTokenStr(){
        $accesstoken=Accesstoken::model()->find("expirestime>".time());
        if(is_null($accesstoken)){
            $atArr=weixin::getAccessToken($this->Appid,$this->Appsecret);
            $accesstoken=new Accesstoken;
            $accesstoken->accesstoken=$atArr['access_token'];
            $accesstoken->expirestime=time()+$atArr['expires_in'];
            $accesstoken->save();
        }
        return $accesstoken->accesstoken;
    }

    //将收到的图片下载到本地
    private function downLoadPic($media_id,$openid){
        $accesstoken=$this->getAccessTokenStr();
        $weixin=new weixin;
        $weixin->getPic($openid,$accesstoken,$media_id);
    }

    private function inputUserData($data){
        $openid=$data['openid'];
        $userdata=Userdata::model()->find("openid='".$openid."'");
        if($userdata){
            $userdata->lastlogintime=time();
        }else{
            $userdata=new Userdata();
            foreach($data as $k=>$v){
                $userdata->$k=$v;
            }
            $userdata->createtime=time();
            $userdata->lastlogintime=time();
        }
        if($userdata->save()){
            return true;
        }else{
            return false;
        }
    }

    public function actionTest(){
        $a=$this->inputUserData(array(
            'openid'=>'12345',
        ));
        if($a){
            echo "yes";
        }else{
            echo "no";
        }

    }
    public function actionTest2(){
            echo time();
    }
    public function actionTest3(){

    }
}
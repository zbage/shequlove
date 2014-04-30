<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-25
 * Time: 下午7:12
 */

class UserinfoModel {
    //返回河南18个地级市
    public function city(){
        return array(
            '0'=>'请选择',
            '1'=>'郑州',
            '2'=>'商丘',
            '3'=>'安阳',
            '4'=>'新乡',
            '5'=>'许昌',
            '6'=>'平顶山',
            '7'=>'信阳',
            '8'=>'南阳',
            '9'=>'开封',
            '10'=>'洛阳',
            '11'=>'焦作',
            '12'=>'济源',
            '13'=>'鹤壁',
            '14'=>'濮阳',
            '15'=>'周口',
            '16'=>'三门峡',
            '17'=>'漯河',
            '18'=>'驻马店'
        );
    }
    public function sex(){
        return array(
            1=>'女',
            2=>'男'
        );
    }
    public function income(){
        return array(
          0=>'请选择',
          1=>'0~2999',
          2=>'3000~4999',
          3=>'5000~7999',
          4=>'8000~9999',
          5=>'10000以上'
        );
    }
    public function education(){
        return array(
            0=>'请选择',
            1=>'初中及以下',
            2=>'中专',
            3=>'高中',
            4=>'大专',
            5=>'本科',
            6=>'研究生',
            7=>'研究生以上'
        );
    }
    public function house(){
        return array(
            1=>'已购房',
            2=>'未购房'
        );
    }

    public function permission($num){
        switch($num){
            case 1:
                return "id,nickname,age,location,sex,photo";
                break;
            case 2:
                return "id,nickname,age,location,sex,photo,height,profession,introduce,request";
                break;
            case 3:
                return "id,nickname,age,location,sex,photo,height,profession,introduce,request,income,education,house";
                break;
            case 4:
                return "id,nickname,age,location,sex,photo,height,profession,introduce,request,income,education,house,qqnum,wxusername,phone";
        }

    }

    public function chval($key,$val){
        switch($key){
            case 'location':
                $res=$this->city();
                return $res[$val];
                break;
            case 'sex':
                $res=$this->sex();
                return $res[$val];
                break;
            case 'income':
                $res=$this->income();
                return $res[$val];
                break;
            case 'education':
                $res=$this->education();
                return $res[$val];
                break;
            case 'house':
                $res=$this->house();
                return $res[$val];
                break;
            default:
                return $val;
        }
    }

    public static function chkey($key){
        $chk=array(
            'nickname'=>'昵称',
            'location'=>'出没地带',
            'age'=>'年龄',
            'sex'=>'性别',
            'height'=>'身高',
            'profession'=>'职业',
            'income'=>'月收入',
            'education'=>'受教育程度',
            'house'=>'购房情况',
            'introduce'=>'自我介绍',
            'request'=>'交友要求',
            'qqnum'=>'QQ号码',
            'wxusername'=>'微信帐号',
            'phone'=>'电话号码'
        );
        if(is_null($chk[$key])){
            return null;
        }
        return $chk[$key];
    }

    public function bewatch($id){
        $userinfo=Userinfo::model()->find(array(
            'select'=>'bewatch',
            'condition'=>"id=".$id,
        ));
        $num=$userinfo->bewatch+1;
        return $rows=Userinfo::model()->updateAll(array('bewatch'=>$num),'id='.$id);
    }

    public function beconcerned($id){
        $userinfo=Userinfo::model()->find(array(
            'select'=>'beconcerned',
            'condition'=>"id=".$id,
        ));
        $num=$userinfo->beconcerned+1;
        return $rows=Userinfo::model()->updateAll(array('beconcerned'=>$num),'id='.$id);
    }

    public static function lastlogin($qqnum){
        return $rows=Userinfo::model()->updateAll(array('lastlogintime'=>time()),'qqnum='.$qqnum);
    }

    public function findQQbyId($id){
        $userinfo=Userinfo::model()->find(array(
            'select'=>'qqnum',
            'condition'=>'id='.$id
        ));
        return $userinfo['qqnum'];
    }
}

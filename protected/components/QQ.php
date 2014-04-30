<?php
class QQ{
    public static function isValidUser(){
        if(self::isLogin()){
            $valid=Userinfo::model()->find(array(
                'select'=>'valid',
                'condition'=>"qqnum=".$_COOKIE['uin'],
            ));
            if($valid != 0){
                return true;
            }
        }
        return false;
    }
    public static function isLogin(){
        if($_COOKIE['uin']){
            return true;
        }else{
            return false;
        }
    }

}
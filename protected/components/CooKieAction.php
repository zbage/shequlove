<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-24
 * Time: 下午5:39
 */

//对cookie相关操作的快捷用法
class CooKieAction {

    public   function setCookie($key=null,$value=null,$expiretime=3600){
        if(!is_string($key) || !is_string($value) || !is_numeric($expiretime)){
            return null;
        }
        $cookie=new CHttpCookie($key,$value);
        $cookie->expire=$expiretime+time();
        Mod::app()->request->cookies[$key]=$cookie;
    }

    public function getCookie($key=null){
        if(!is_string($key)) return null;
        return Mod::app()->request->cookies[$key];
    }

    public function delCookie($key=null){
        if(!is_string($key)) return null;
        $cookie=Mod::app()->request->getCookies();
        unset($cookie[$key]);
    }
} 
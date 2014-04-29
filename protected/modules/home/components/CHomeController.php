<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-29
 * Time: 上午11:39
 */

class CHomeController  extends CController{
    public $layout='//layouts/home';

    public function filters(){
        $oid=is_null($_COOKIE['openid'])?"wrong":$_COOKIE['openid'];
        if(!QQ::isValidUser()){
            $this->redirect('/auth/default/index?oid='.$oid);
        }
    }

} 
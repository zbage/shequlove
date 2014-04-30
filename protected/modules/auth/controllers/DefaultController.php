<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-24
 * Time: 上午10:31
 */

class DefaultController extends CAuthController{

    private $s_url='';      //跳转的页面
    private $login_url='http://ui.ptlogin2.qq.com/cgi-bin/login?style=8&appid=1006102&daid=1&s_url=http%3A%2F%2Fid.qq.com&low_login=0';
    private $openId=null;
    private $pic;

    public function actionIndex($oid){
        $Co=new CooKieAction();
        $this->openId=$oid;
        $userdata=Userdata::model()->find("openid='".$oid."'");
        $this->pic=PIC_SAVE_PATH.$this->openId.".jpg";
        if(is_null($this->openId) || is_null($userdata)){
            //如果url中没有传递openId或者openId没有存在数据库中，非法请求
            $this->noOpenId();
        }elseif(!file_exists($this->pic)){
            //如果有这个openId,但是没有图片，非法请求
            $this->noPic();
        }elseif(!QQ::isValidUser()){
            //暂时没有域名的替代方案
            $Co->setCookie('openid',$this->openId);
            $this->redirect('/auth/default/qqlogin');
        }else{
            //这里面我用了qq号码，暂时，以后需要修改
            UserinfoModel::lastlogin($_COOKIE['uin']);
            $this->redirect('/home/home/home');
        }
    }

    public  function noOpenId(){
        $this->render('error1');
    }
    public  function noPic(){
        $this->render('error2');
    }

    public  function actionQqlogin(){
        if(is_null($_COOKIE['openid'])){
            $this->render('error3');
        }elseif(isset($_POST['qqnum'])){
            Mod::app()->session['openid']=$_COOKIE['openid'];
            $userinfo=Userinfo::model()->find("qqnum='".$_POST['qqnum']."'");
            $Co=new CooKieAction();
            if($userinfo->valid != 0){
                $Co->setCookie('uin',$_POST['qqnum']);
                $this->redirect('/home/home/home');
            }else{
               $Co->setCookie('uin',$_POST['qqnum']);
               $this->redirect('/auth/default/inputinfo');
            }
        }else{
            $this->render('qqlogin');
        }
    }

    public function actionInputinfo(){
        if(is_null($_COOKIE['uin'])){
            $this->render('error3');
        }else{
            $userinfo=new Userinfo();
             if(isset($_POST['Userinfo'])){
                 $userinfo->qqnum=$_COOKIE['uin'];
                 $userinfo->openid=$_COOKIE['openid'];
                 $userinfo->photo=$_COOKIE['openid'].".jpg";
                 $userinfo->attributes=$_POST['Userinfo'];
                 $userinfo->valid=1;
                 if($userinfo->save()){
                     $this->redirect('/home/home/home');
                 }
             }else{
                 $userinfoModel=new UserinfoModel();
                 $this->render('inputinfo',array(
                     'userinfo'=>$userinfo,
                     'city'=>$userinfoModel->city(),
                     'sex'=>$userinfoModel->sex(),
                     'income'=>$userinfoModel->income(),
                     'education'=>$userinfoModel->education(),
                     'house'=>$userinfoModel->house(),
                     'qqnum'=>$_COOKIE['uin']
                 ));
             }
        }
    }
    public function actionTest(){
    echo time();
    }
}
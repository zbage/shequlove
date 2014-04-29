<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-22
 * Time: 下午4:32
 */

class CWeixinController extends CController{
    //大豫共享测试号wx0b333f05745c8886
    public  $Appid="wx0b333f05745c8886";
    public  $Appsecret="3a9a4773b86a65a9b113153c051ceb7b";
    public  $token='dayuwang';

    //当用户进入发送图片环境后的多少秒内发送数据是有效的时间
    public $expireImgCache=60;

    //当用户输入发送图片后，多少秒内登录QQ算为有效
    public $QQLoginTime=600;
}
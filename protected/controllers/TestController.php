<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-24
 * Time: 下午6:02
 */

class TestController extends CController{
    function actionTest(){
        $test=new QQ;
        $test->isValidUser();
    }
} 
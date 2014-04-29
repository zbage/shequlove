<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-25
 * Time: 上午12:30
 */

//本数据库主要用户存储帐号信息
class Userdata extends CActiveRecord{

    public static function model($classname=__CLASS__){
        return parent::model($classname);
    }
    public function tableName(){
        return "{{userdata}}";
    }
}
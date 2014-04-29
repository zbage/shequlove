<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-23
 * Time: 上午10:40
 */
//建议以后使用memcache来替代
class Imgcache extends CActiveRecord{
    //AR的两个方法不能少，model和tablename
    public static function model($classname=__CLASS__){
        return parent::model($classname);
    }

    public function tableName(){
        return '{{imgcache}}';
    }

    public function rules(){
        return array(
            array('fromusername,createtime','safe')
        );
    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-23
 * Time: 下午4:47
 */

class Accesstoken extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return '{{accesstoken}}';
    }
} 
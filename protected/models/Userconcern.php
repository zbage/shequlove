<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-29
 * Time: 下午10:31
 */

class userconcern extends CActiveRecord{

    public static function model($tableName=__CLASS__){
        return parent::model($tableName);
    }

    public function tableName(){
        return "{{userconcern}}";
    }
} 
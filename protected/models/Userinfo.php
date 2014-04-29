<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-25
 * Time: 下午4:11
 */

class Userinfo extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "{{userinfo}}";
    }

    public function attributeLabels(){
        return array(
            'nickname'=>'昵称',
            'location'=>'出没地带',
            'age'=>'年龄',
            'height'=>'身高',
            'profession'=>'职业',
            'income'=>'月收入',
            'education'=>'学历',
            'house'=>'购房情况',
            'introduce'=>'自我介绍',
            'request'=>'征友要求',
            'sex'=>'性别',
            'wxusername'=>'微信帐号',
            'phone'=>'电话号码',
            'qqnum'=>'QQ号码'
        );
    }
    public function rules(){
        return array(
            array('nickname,age,height,profession,introduce,request,wxusername','required','message'=>'必填项'),
            array('nickname','length','min'=>1,'max'=>10,'tooShort'=>'可以再长一点','tooLong'=>'昵称过长'),
            array('location','numerical','min'=>1,'tooSmall'=>'请选择您的出没地带'),
            array('age','numerical','min'=>12,'max'=>99,'tooSmall'=>'您输入的年龄过小，请认真填写','tooBig'=>'您输入的年龄过大，请认真填写'),
            array('sex','numerical','min'=>1,'tooSmall'=>'请选择您的性别'),
            array('height','numerical','min'=>50,'max'=>240,'tooSmall'=>'请认真填写身高，不要过小','tooBig'=>'营养能不能不这么好！'),
            array('income','numerical','min'=>1,'tooSmall'=>'请选择您的收入'),
            array('education','numerical','min'=>1,'tooSmall'=>'请选择您的受教育程度'),
            array('house','numerical','min'=>1,'tooSmall'=>'请选择您的购房情况'),
            array('introduce','length','min'=>5,'max'=>200,'tooShort'=>'多描述自己，有利于他人认识你','tooLong'=>'最长只能输入200个字'),
            array('request','length','min'=>5,'max'=>200,'tooShort'=>'更多的描述，帮助你更快的找到想要的人','tooLong'=>'最长只能输入200个字'),
            array('qqnum,openid,valid,nickname,location,age,height,profession,income,education,house,introduce,request,sex,wxusername,phone','safe')
        );
    }
} 
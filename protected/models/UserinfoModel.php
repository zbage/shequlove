<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-25
 * Time: 下午7:12
 */

class UserinfoModel {
    //返回河南18个地级市
    public function city(){
        return array(
            '0'=>'请选择',
            '1'=>'郑州',
            '2'=>'商丘',
            '3'=>'安阳',
            '4'=>'新乡',
            '5'=>'许昌',
            '6'=>'平顶山',
            '7'=>'信阳',
            '8'=>'南阳',
            '9'=>'开封',
            '10'=>'洛阳',
            '11'=>'焦作',
            '12'=>'济源',
            '13'=>'鹤壁',
            '14'=>'濮阳',
            '15'=>'周口',
            '16'=>'三门峡',
            '17'=>'漯河',
            '18'=>'驻马店'
        );
    }
    public function sex(){
        return array(
            1=>'女',
            2=>'男'
        );
    }
    public function income(){
        return array(
          0=>'请选择',
          1=>'0~2999',
          2=>'3000~4999',
          3=>'5000~7999',
          4=>'8000~9999',
          5=>'10000以上'
        );
    }
    public function education(){
        return array(
            0=>'请选择',
            1=>'初中及以下',
            2=>'中专',
            3=>'高中',
            4=>'大专',
            5=>'本科',
            6=>'研究生',
            7=>'研究生以上'
        );
    }
    public function house(){
        return array(
            1=>'已购房',
            2=>'未购房'
        );
    }
} 
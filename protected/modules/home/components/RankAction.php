<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-26
 * Time: 下午11:11
 */

class RankAction {
    private $pageUserNum=9;       //每页显示的用户数
    private $offset;
    //传递进来排序方法和本页是第几页
    /*
     * rankAction有
     * 1.根据最近登录时间排序   lastLogin
     * 2.根据被暗恋次数排序     beConcerned
     * 3.被查看次数排序        beWatch
     */
    public function rank($rankAction,$num){
        $offset=$this->pageUserNum*$num;
        switch($rankAction){
            case 'lastLogin':
                return $this->lastLogin($offset);
                break;
            case 'beConcerned':
                return $this->beConcerned($offset);
                break;
            case 'beWatch':
                return $this->beWatch($offset);
                break;
            default:
                return "rankAction wrong";
        }
    }

    private function  getData($request){
        $tablename=ucwords($request['tablename']);
        unset($request['tablename']);
        $data=$tablename::model()->findAll($request);
        return $data;
    }

    private function beWatch($offset){
        $request=array(
            'tablename'=>'userinfo',
            'select'=>'qqnum',
            'order'=>'bewatch',
            'limit'=>$offset.",".$this->pageUserNum
        );
        return $this->getData($request);
    }

    private function beConcerned($offset){
        $request=array(
            'tablename'=>'Userinfo',
            'select'=>'qqnum',
            'order'=>'beconcerned DESC',
            'limit'=>$offset.",".$this->pageUserNum
        );
        return $this->getData($request);
    }

    private function lastLogin($offset){
        $request=array(
            'tablename'=>'Userinfo',
            'select'=>'qqnum',
            'order'=>'lastlogintime DESC',
            'limit'=>"$offset".","."$this->pageUserNum"
        );
        return $this->getData($request);
    }

} 
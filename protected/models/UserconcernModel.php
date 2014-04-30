<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-29
 * Time: 下午10:38
 */

class UserconcernModel {

    private $createUC;
    private $selectUC;

    function __construct(){
        $this->selectUC=Userconcern::model();
    }

    public  function create($users=array(),$returnData=false){
        $checkRes=$this->check($users,$returnData);
        if(!is_null($checkRes)){
            return $checkRes;
        }
        $createUC=new Userconcern;
        foreach($users as $k=>$v){
            $createUC->$k=$v;
        }
        $createUC->createtime=time();
        if($createUC->save()){
            return "[{tip:'关注成功'}]";
        }
    }

    public function checkEach($users=array(),$returnData=false){
        $sql="SELECT a.id,a.fromuser,a.touser
        FROM love_userconcern AS a
        INNER JOIN love_userconcern AS b ON a.fromuser = b.touser
        AND a.touser = b.fromuser";

        foreach($users as $k=>$v){
            $sql.=" AND a.".$k."=".$v;
        }
        $sql.=";";
        $eachConcern=$this->selectUC->findBySql($sql);
        if(is_null($eachConcern)){
            return null;
        }
        if($returnData){
            return $eachConcern;
        }else{
            return "[{tip:'已经相互关注'}]";
        }
    }

    public function check($users=array(),$returnData=false){
        $eachConcern=$this->checkEach($users,$returnData);
        if(!is_null($eachConcern)){
                return $eachConcern;
        }
        foreach($users as $k=>$v){
            $condition.=" and ".$k."=".$v;
        }
        $condition=ltrim($condition,' and ');
        $concern=$this->selectUC->find(array(
            'condition'=>$condition
        ));
        if(!is_null($concern)){
            if($returnData){
                return $concern;
            }else{
                return "[{tip:'已经关注'}]";
            }
        }else{
            return null;
        }

    }

} 
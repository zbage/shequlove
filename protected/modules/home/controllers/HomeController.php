<?php
/**
 * Created by PhpStorm.
 * User: wangchen
 * Date: 14-4-25
 * Time: 下午8:39
 */


class HomeController extends CHomeController{

    public function actionHome(){
        $rankAction=new RankAction();
        $data=$rankAction->rank('beWatch',1);
        $usersBasicInfo=$this->getUsersBasicInfo($data);
        $this->render('home',array('usersBasicInfo'=>$usersBasicInfo));
    }

    private function  getData($request){
        $tablename=ucwords($request['tablename']);
        unset($request['tablename']);
        $data=$tablename::model()->find($request);
        return $data;
    }

    private function getUsersBasicInfo($data){
        $usersBasicInfo=array();
        foreach($data as $k){
            $request=array(
                'tablename'=>'Userinfo',
                'select'=>$this->userinfoModel->permission(1),
                'condition'=>'qqnum='.$k['qqnum'],
            );
            $usersBasicInfo[]=$this->getData($request);
            $lastarr=count($usersBasicInfo)-1;
            foreach($usersBasicInfo[$lastarr] as $_k=>$_v){
                $usersBasicInfo[$lastarr][$_k]=$this->userinfoModel->chval($_k,$_v);
            }
        }
        return $usersBasicInfo;
    }

    private function getUserGeneralinfo($id,$permission=2){
        $this->userinfoModel->bewatch($id);
        $request=array(
            'tablename'=>'userinfo',
            'select'=>$this->userinfoModel->permission($permission),
            'condition'=>'id='.$id
        );
        return $this->getData($request);
    }

    public function actionShowinfo($id){
        $permission=2;
        $uc=new UserconcernModel();
        $concern=$uc->checkEach(array('fromuser'=>$_COOKIE['uin'],'touser'=>$this->userinfoModel->findQQbyId($id)),true);
        if(!is_null($concern->id)){
            $permission=4;
        }else{
            $concern=$uc->check(array('fromuser'=>$_COOKIE['uin'],'touser'=>$this->userinfoModel->findQQbyId($id)),true);
            if(!is_null($concern->id)){
                $permission=3;
            }
        }
        $userinfo=$this->getUserGeneralinfo($id,$permission);
        foreach($userinfo as $k=>$v){
            $userinfo[$k]=$this->userinfoModel->chval($k,$v);
            //unset($userinfo[$k]);
        }
        $this->renderPartial('userinfo',array('userinfo'=>$userinfo));
    }

    /*
     * 传递进来的$con值
     * 0表示检查是否已经关注
     * 1表示创建关注
     */
    public function actionConcern($con,$id){
        $uc=new UserconcernModel();
        $touser=$this->userinfoModel->findQQbyId($id);
        if($con == 1){
            $res=$uc->create(array('fromuser'=>$_COOKIE['uin'],'touser'=>$touser));
            $this->userinfoModel->beconcerned($id);
            echo $res;
        }elseif($con==0){
            $res=$uc->check(array('fromuser'=>$_COOKIE['uin'],'touser'=>$touser));
            if(is_null($res)){
                echo "{[tip:'未关注']}";
            }else{
                echo $res;
            }
        }
    }

    public function actionTest(){
        $uc=new UserconcernModel();
        $res=$uc->create(array('fromuser'=>'103','touser'=>'101'));
        print_r($res);
    }
}
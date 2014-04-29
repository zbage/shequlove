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
        $data=$rankAction->rank('lastLogin',1);
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
                'select'=>"nickname,age,location,sex,photo",
                'condition'=>'openid='.$k['openid'],
            );
            $usersBasicInfo[]=$this->getData($request);
        }
        return $usersBasicInfo;
    }

    public function actionTest(){
        $this->render('aaa');
    }

}
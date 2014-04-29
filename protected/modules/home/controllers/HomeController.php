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
                'select'=>$this->userinfoModel->permission(1),
                'condition'=>'openid='.$k['openid'],
            );
            $usersBasicInfo[]=$this->getData($request);
        }
        return $usersBasicInfo;
    }

    private function getUserGeneralinfo($id,$permission=2){
        $request=array(
            'tablename'=>'userinfo',
            'select'=>$this->userinfoModel->permission($permission),
            'condition'=>'id='.$id
        );
        return $this->getData($request);
    }

    public function actionShowinfo($id){
        $userinfo=$this->getUserGeneralinfo($id);
        /*
         * 这路查看用户是否关注
         */
        foreach($userinfo as $k=>$v){
            if(!is_null($v)){
                    $userdata[$k]=$v;
            }
        }
        
        $this->renderPartial('userinfo',array('userinfoModel'=>$this->userinfoModel,'userinfo'=>$userinfo));
    }
}
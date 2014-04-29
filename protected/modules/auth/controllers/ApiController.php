<?php

class ApiController extends CApiController
{
    /**
     * 根据身份返回导航菜单
     */
    public function actionGet()
    {
        if (Auth::instance()->isGuest) {
            $this->needLogin();
        } else {
            $user = User::model()->findByPk(Auth::instance()->uin);

            if (is_null($user)) {
                $this->errorMessage('没有权限');
                return;
            }

            $menu = array(
                'microhome' => '微首页',
            );
            $this->response($menu);
        }
    }

    /**
     * 获取登录状态
     */
    public function actionPost()
    {
        if (Auth::instance()->isGuest) {
            return;
        }

        $user = User::model()->findByPk(Auth::instance()->uin);

        if (is_null($user)) {
            $this->errorMessage('没有权限');
            return;
        }

        $this->response($user);
    }
}
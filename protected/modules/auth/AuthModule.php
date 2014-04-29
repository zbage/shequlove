<?php

class AuthModule extends WebModule
{
    public $useFake = FALSE;

    protected function init()
    {
        parent::init();

        Mod::import('system.components.user.CPtUser');
        Auth::$useFake = $this->useFake;
    }
}
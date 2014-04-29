<?php

class Auth
{
    static $_instance;
    static $useFake = FALSE;

    /**
     * @return CPtUser|FakePtUser
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = Auth::$useFake ? new FakePtUser()
                : new CPtUser();
        }

        return self::$_instance;
    }
}
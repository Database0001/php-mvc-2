<?php

namespace Modules;

use Src\Models\User;

class Auth
{

    public static $model;

    public static function init()
    {
        self::$model = new User(0);

        return new self();
    }

    public static function check()
    {
        if (session('uid')) {
            self::user();
            return true;
        }

        return false;
    }

    public static function attempt($arr = [])
    {

        if (session('uid'))
            return false;

        return self::login(self::$model->where($arr)->get()[0] ?? []);
    }

    public static function login($user = [])
    {
        if (@$user['id']) {
            session(['uid' => $user['id']]);
            return 1;
        }

        return null;
    }

    public static function logout()
    {
        return deleteSession('uid');
    }

    public static function user()
    {
        if (!session('uid'))
            return false;

        return self::$model->where([['id', '=', session('uid')]])->get()[0] ?? deleteSession('uid');
    }
}

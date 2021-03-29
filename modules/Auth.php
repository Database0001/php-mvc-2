<?php

namespace Modules;

use Src\Models\User;

class Auth
{

    public static function attempt($arr = [])
    {

        if (session('uid'))
            return false;

        $model = new User(0);

        return self::login($model->where($arr)->get()[0] ?? []);

        return 0;
    }

    public static function login($user = [])
    {
        if (@$user['id']) {
            session(['uid' => $user['id']]);
            return 1;
        }
    }

    public static function logout()
    {
        return deleteSession('uid');
    }

    public static function user()
    {
        if (!session('uid'))
            return false;

        $model = new User(0);

        return $model->where([['id', '=', session('uid')]])->get()[0] ?? false;
    }
}

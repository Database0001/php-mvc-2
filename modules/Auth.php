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
        $user = $model->where($arr)->get();

        if (@$user['id']) {
            session(['uid' => $user['id']]);
            return 1;
        }

        return 0;
    }
}

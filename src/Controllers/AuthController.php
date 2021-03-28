<?php

namespace Src\Controllers;

use Modules\Auth;

class AuthController
{
    public function signin()
    {
        $valid = validator(request(), [
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        $return = [
            'response' => 0
        ];

        if (Auth::attempt([['email', "=", $valid['email']], ['password', "=", $valid['password']]])) {
            $return['response'] = 1;
        } else {
            $return['message'] = "E-mail veya şifre yanlış.";
        }

        return response('json', $return);
    }
}

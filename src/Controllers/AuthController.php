<?php

namespace Src\Controllers;

use App\Helpers\Crypter;
use Modules\Auth;
use Src\Models\User;

class AuthController
{

    public $userModel;

    public function __construct()
    {
        $this->userModel = new User(0);
    }

    public function signin()
    {
        $valid = validator(request(), [
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        $return = [
            'response' => 0
        ];

        if (Auth::attempt([['email', "=", $valid['email']], ['password', "=", Crypter::encode($valid['password'])]])) {
            $return['response'] = 1;
        } else {
            $return['message'] = "E-mail veya şifre yanlış.";
        }

        return response('json', $return);
    }

    public function signup()
    {
        $valid = validator(request(), [
            "username" => ['required'],
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        $return = [
            'response' => 1
        ];

        $user = $this->userModel->create([
            "username" => $valid['username'],
            "email" => $valid['email'],
            "password" => Crypter::encode($valid['password'])
        ]);

        Auth::login($user);

        return response('json', $return);
    }
}

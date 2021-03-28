<?php

namespace Src\Controllers;

class AuthController
{
    public function signin()
    {
        $valid = validator(request(), [
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        

        return response('json', $valid);
    }
}

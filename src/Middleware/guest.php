<?php

namespace Src\Middleware;

class guest
{

    public $return;

    public $redirect;

    public function __construct()
    {

        $this->redirect = host('/auth/signin');

        if (!session('uid')) {
            $this->return = true;
        } else {
            $this->return =  false;
        }
    }
}

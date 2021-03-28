<?php

namespace Src\Middleware;

class auth
{

    public $return;

    public $redirect;

    public function __construct()
    {

        $this->redirect = host('/');

        if (session('uid')) {
            $this->return = true;
        } else {
            $this->return =  false;
        }
    }
}

<?php

function base_path($url = null)
{
    return dirname(__DIR__) . $url;
}

function public_path($url = null)
{
    return base_path('\public_path') . $url;
}

function url($url = null)
{
    return $_SERVER['REQUEST_URI'] . $url;
}

function abort($code, $_data = [])
{

    $data = [
        'message' => null,
        'view' => 1
    ];

    foreach ($_data as $key => $val) {
        $data[$key] = $val;
    }

    if ($data['view'])
        echo view("errors.$code", ['message' => $data['message']], ['can_abort' => 0]);

    die(http_response_code($code));
}

function request($name = null)
{
    return $name ? @$_REQUEST[$name] : $_REQUEST;
}

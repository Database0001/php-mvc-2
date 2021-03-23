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

function abort($code)
{
    die(http_response_code($code));
}

function request($name = null)
{
    return $name ? @$_REQUEST[$name] : $_REQUEST;
}

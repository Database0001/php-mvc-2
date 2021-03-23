<?php

function base_path($url = null)
{
    return dirname(__DIR__) . $url;
}

function public_path($url = null)
{
    return base_path('\public_path') . $url;
}

function host()
{
    $protocol = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://";
    $port = $_SERVER['SERVER_PORT'];

    $dont_show_port = [80, 443];

    return $protocol . $_SERVER['SERVER_NAME'] . (!empty($port) && !in_array($port, $dont_show_port) ? ":$port" : null);
}

function url($url = null)
{
    return $url == null ? $_SERVER['REQUEST_URI'] : host() . "/$url";
}

function ip()
{
    return ($_SERVER['HTTP_CLIENT_IP'] ?? ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']));
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

function session()
{

    $args = func_get_args();

    if (!isset($args[0]))
        return $_SESSION;

    $type = gettype($args[0]);

    if ($type == "string") {
        if (isset($args[0]))
            return $_SESSION[$args[0]] ?? ($_SESSION[@$args[1]] ?? null);
    } elseif ($type == "array") {
        if (isset($args[0]))
            foreach ($args[0] as $key => $val) {
                $_SESSION[$key] = $val;
            }

        return true;
    }

    return false;
}

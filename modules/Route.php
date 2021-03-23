<?php

namespace Modules;

class Route
{

    static $called = 0;

    private static function main($url, $callback, $methods = [])
    {
        if (self::$called == 1 || !in_array(request('_method') ?? $_SERVER['REQUEST_METHOD'], $methods))
            return;

        $uri = strtok(strtok(url(), '?'), '#');

        $_uri = explode("/", $uri);
        $_url = explode("/", $url);
        $params = [];

        foreach ($_url as $key => $val) {

            $hard = !empty(strstr($val, '?'));

            if (preg_match('/[^a-zA-Z0-9]+/i', $val) || $hard) {
                $uri_val = $_uri[$key] ?? null;

                if ($hard) {
                    $_uri[$key] = $uri_val;
                }

                if ($uri_val || $hard) {
                    $_url[$key] = $uri_val;
                    $params[] = rawurldecode($uri_val);
                }
            }
        }

        if ($_uri == $_url) {
            $callback_type = gettype($callback);

            switch ($callback_type) {
                case "object":
                    $return = call_user_func_array($callback, $params);
                    break;

                case "array":

                    $file = base_path("\\$callback[0].php");
                    include($file);
                    $class = new $callback[0]();
                    $return = call_user_func_array([$class, $callback[1]], $params);
                    break;

                default:
                    abort(500);
            }

            print_r($return);
            self::$called = 1;
        }
    }

    public static function get()
    {
        $args = func_get_args();
        return self::main($args[0], $args[1], ['GET']);
    }

    public static function post()
    {
        $args = func_get_args();
        return self::main($args[0], $args[1], ['POST']);
    }
}

<?php

namespace App\Helpers;

class Crypter
{

    const key = 'TestKey';
    const salt = 'ThisSaltIsSecret';

    public static function decode($xml)
    {

        $xml = base64_decode(str_replace([self::salt], '', $xml));
        $keys = self::key;

        $decrypted = "";
        for ($i = 0; $i < strlen($xml); $i++) {
            $decrypted .= chr(ord($xml[$i]) - ord($keys[($i + 1) % strlen($keys)]));
        }
        return $decrypted;
    }

    public static function encode($xml)
    {
        $keys = self::key;

        $encrypted = "";
        for ($i = 0; $i < strlen($xml); $i++) {
            $encrypted .= chr(ord($xml[$i]) + ord($keys[($i + 1) % strlen($keys)]));
        }
        return base64_encode($encrypted) . self::salt;
    }

    public static function encodeArray($array = [], $except = [])
    {
        foreach ($array as $key => $val) {
            if (!strstr($val, self::salt) && !in_array($key, $except)) {
                $array[$key] = self::encode($val);
            }
        }

        return $array;
    }

    public static function decodeArray($array = [])
    {
        foreach ($array as $key => $val) {
            if (strstr($val, self::salt)) {
                $array[$key] = self::decode($val);
            }
        }

        return $array;
    }

    public static function getKey()
    {
        return self::key;
    }
}

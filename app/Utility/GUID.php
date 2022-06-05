<?php
namespace App\Utility;

class GUID
{
    public static function gen($trim=false)
    {
        // if (function_exists('com_create_guid') === true) {
        //     if ($trim === true)
        //         return trim(com_create_guid(), '{}');
        //     else
        //         return com_create_guid();
        // }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
        }
    }
}
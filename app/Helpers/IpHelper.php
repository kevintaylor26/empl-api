<?php

namespace App\Helpers;


class IpHelper
{
    // 获取客户端真实IP
    private static $white_list = [
        '38.72.143.140'
    ];

    public static function GetIP(): mixed
    {
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
//            Log::error('ip1:::', [$_SERVER['REMOTE_ADDR']]);
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return request()->ip();
        }
    }

    public static function CheckValidIp(): bool
    {
        if(in_array(self::GetIP(), self::$white_list)) {
            return true;
        }
        return false;
    }
}

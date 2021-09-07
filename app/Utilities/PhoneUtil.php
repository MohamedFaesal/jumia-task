<?php

declare(strict_types=1);

namespace App\Utilities;

class PhoneUtil
{
    const CAMERON_CODE = 237;
    const ETHIOPIA_CODE = 251;
    const MOROCCO_CODE = 212;
    const MOZAMBIQUE_CODE = 258;
    const UGANDA_CODE = 256;

    public static function Countries() : array
    {
        return [
            self::CAMERON_CODE => 'Cameron',
            self::ETHIOPIA_CODE => 'Ethiopia',
            self::MOROCCO_CODE => 'Morocco',
            self::MOZAMBIQUE_CODE => 'Mozambique',
            self::UGANDA_CODE => 'Uganda',
        ];
    }

    public static function regex() : array
    {
        return [
            self::CAMERON_CODE => '/[2368]\d{7,8}$/',
            self::ETHIOPIA_CODE => '/[1-59]\d{8}$/',
            self::MOROCCO_CODE => '/[5-9]\d{8}$/',
            self::MOZAMBIQUE_CODE => '/[28]\d{7,8}$/',
            self::UGANDA_CODE => '/\d{9}$/',
        ];
    }

    public static function getCountryByCode($code) : string
    {
        return self::Countries()[$code] ?? "Unknown";
    }

    public static function getRegexForCode($code) : string
    {
        return self::regex()[$code] ?? "";
    }
}

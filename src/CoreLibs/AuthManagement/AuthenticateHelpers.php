<?php
namespace App\CoreLibs\AuthManagement;

class AuthenticateHelpers {

    public static function getRandomSalt($length) {
        $lengthOfRandomSalt = $length;
        $possibleRandomChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomSalt = '';
        for ($i = 0; $i < $lengthOfRandomSalt; $i++) {
            $randomSalt .= $possibleRandomChars[random_int(0, 61)];
        }
        return $randomSalt;
    }
}
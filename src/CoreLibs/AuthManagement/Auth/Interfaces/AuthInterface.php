<?php

namespace App\CoreLibs\AuthManagement\Auth\Interfaces;

interface AuthInterface {

    function signUp($username, $hashedpass);

    function logIn($username, $hashedpass);

    function logOut($token);
}
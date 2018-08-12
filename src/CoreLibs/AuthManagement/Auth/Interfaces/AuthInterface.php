<?php

namespace App\CoreLibs\AuthManagement\Auth\Interfaces;

interface AuthInterface {

    function signUp($username, $hashedpass);

    function logIn($username, $hashedpass);

    function logOut($token);

    function getUserInfo($token);

    function checkAuthByToken($token);

    function checkIfUserIsAdminByToken($token);

    public function setUserAsAdmin($username);

    public function setUserAsUser($username);

    public function deleteUserByUsername($username);
    
}
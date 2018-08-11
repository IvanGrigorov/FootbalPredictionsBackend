<?php

namespace App\CoreLibs\AuthManagement\Auth\Lib;
use \App\CoreLibs\AuthManagement\Auth\Interfaces\AuthInterface;
use App\CoreLibs\AuthManagement\AuthenticateHelpers;
use App\Entity\Users;
use App\Entity\AuthenticationTokens;




class AuthManager implements AuthInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    function signUp($username, $hashedPass) {
        $salt = AuthenticateHelpers::getRandomSalt(10);
        $saltedPass = crypt($hashedPass, $salt);

        // Check for same username 
        $sameUsernameEntities = $this->repo->findByUsername($username);
        if (!empty($sameUsernameEntities)) {
            return array(
                'Error' => 'DuplicateUserError',
                'Msg' => 'There is already a user with that username'
            );
        }

        // Save user if everithing is ok
        $user = new Users();
        $user->setName($username);
        $user->setPassword($saltedPass);
        $user->setSalt($salt);
        $this->entityMngr->persist($user);
        $this->entityMngr->flush();
        return array(
            'Success' => 'UserSignUp',
            'Msg' => 'User has successfully signed up'
        );


    }

    function logIn($username, $hashedPass) {
        // Check for same username 
        $userIfExistsByUsername = $this->repo->findOneByUsername($username);
        if (!empty($sameUsernameEntities)) {
            return
                array(
                    'Error' => 'NoSuchUserError',
                    'Msg' => 'There is no such user with this username'
                );
            
        }
        $saltForUser = $userIfExistsByUsername->getSalt();

        // Succssesful Login
        if (crypt($hashedPass, $saltForUser) == $userIfExistsByUsername->getPassword()) {
            // Set Token
            $token =  AuthenticateHelpers::getRandomSalt(20);
            $authenticationEntity = new AuthenticationTokens();
            $authenticationEntity->setToken($token);
            $authenticationEntity->setUserId($userIfExistsByUsername->getId());
            $this->entityMngr->persist($authenticationEntity);
            $this->entityMngr->flush();
            return 
                array(
                    'Success' => 'SuccssesfulLogin',
                    'Token' => $token
                );
            
        }
        else {
            return 
                array(
                    'Error' => 'NoSuchUserError',
                    'Msg' => 'There is no such user with this password'
                );
            
        }

    }

    function logOut($token) {
        $authenticationTokenEntity = $this->repo->findOneByToken($token);
        if (!empty($authenticationTokenEntity)) {
            $this->entityMngr->remove($authenticationTokenEntity);
            $this->entityMngr->flush();
            return
                array(
                    'Success' => 'SuccessfulLogOut',
                    'Msg' => 'You have logged out successfully'
                );
        
        }
        else {
            return
                array(
                    'Error' => 'LogOutError',
                    'Msg' => 'There was some error when you tried to log out'
                );
            
        }
    }

    function getUserInfo($token) {
        $user = $this->repo->findUserByToken($token);
        if (!empty($user)) {
            return 
                array(
                    'Success' => 'UserInfo',
                    'Msg' => $user->formatUser()
                );
            
        }
        else {
            return 
                array(
                    'Error' => 'ErroGettingUserInfo',
                    'Msg' => 'No user info for this user token'
                );
            
        }
    }

    function checkAuthByToken($token) {
        $userInfoFromRequest = $this->getUserInfo($token);
        if (!isset($userInfoFromRequest['Error'])) {
            return array(
                'Success' => 'Authentocated',
                'Msg' => 'User is authenticated'
            );
        }
        else {
            return array(
                'Error' => 'NotAuthenticated',
                'Msg' => 'Cannot access it without log in'
            );
        }
    }
}
<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\CoreLibs\AuthenticateHelpers;
use App\Entity\Users;
use App\Entity\AuthenticationTokens;



class UserController extends AbstractController
{
    /**
     * @Route("/signUp", name="user_sign_up")
     */
    public function signUp(Request $request)
    {
        $username = $request->request->get('username');
        $hashedPass = $request->request->get('password');
        $salt = AuthenticateHelpers::getRandomSalt(10);
        $saltedPass = crypt($hashedPass, $salt);

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Users::class);

        // Check for same username 
        $sameUsernameEntities = $repository->findByUsername($username);
        if (!empty($sameUsernameEntities)) {
            return $this->json(
                array(
                    'Error' => 'DuplicateUserError',
                    'Msg' => 'There is already a user with that username'
                )
            );
        }

        // Save user if everithing is ok
        $user = new Users();
        $user->setName($username);
        $user->setPassword($saltedPass);
        $user->setSalt($salt);
        $entityManager->persist($user);
        $entityManager->flush();


    }

    /**
     * @Route("/logIn", name="user_log_in")
     */
    public function login(Request $request) {


        $username = $request->request->get('username');
        $hashedPass = $request->request->get('password');

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Users::class);

        // Check for same username 
        $userIfExistsByUsername = $repository->findOneByUsername($username);
        if (!empty($sameUsernameEntities)) {
            return $this->json(
                array(
                    'Error' => 'NoSuchUserError',
                    'Msg' => 'There is no such user with this username'
                )
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
            $entityManager->persist($authenticationEntity);
            $entityManager->flush();
            return $this->json(
                array(
                    'Success' => 'SuccssesfulLogin',
                    'Token' => $token
                )
            );
        }
        else {
            return $this->json(
                array(
                    'Error' => 'NoSuchUserError',
                    'Msg' => 'There is no such user with this password'
                )
            );
        }

    }

    /**
     * @Route("/logOut", name="user_log_out")
     */
    public function logout(Request $request) {

        $token = $request->request->get('token');

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(AuthenticationTokens::class);

        $authenticationTokenEntity = $repository->findOneByToken($token);
        if (!empty($authenticationTokenEntity)) {
            $entityManager->remove($authenticationTokenEntity);
            $entityManager->flush();
            return $this->json(
                array(
                    'Success' => 'SuccessfulLogOut',
                    'Msg' => 'You have logged out successfully'
                )
            );
        }
        else {
            return $this->json(
                array(
                    'Error' => 'LogOutError',
                    'Msg' => 'There was some error when you tried to log out'
                )
            );
        }
    }
    /**
     * @Route("/info", name="user_info")
     */
    public function info(Request $request) {
        $token = $request->request->get('token');
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->findUserByToken($token);
        if (!empty($user)) {
            return $this->json(
                array(
                    'Success' => 'UserInfo',
                    'Msg' => $user->formatUser()
                )
            );
        }
        else {
            return $this->json(
                array(
                    'Error' => 'ErroGettingUserInfo',
                    'Msg' => 'No user info for this user token'
                )
            );
        }



    }

}

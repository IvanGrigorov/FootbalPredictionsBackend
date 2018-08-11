<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;
use App\Entity\AuthenticationTokens;
use App\CoreLibs\AuthManagement\Auth\Lib\AuthManager;



class UserController extends CustomAbstractController
{
    /**
     * @Route("/signUp", name="user_sign_up")
     */
    public function signUp(Request $request)
    {
        $username = $request->request->get('username');
        $hashedPass = $request->request->get('password');
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $authManager = new AuthManager($repository, $entityManager);
        return $this->json($authManager->signUp($username, $hashedPass));


    }

    /**
     * @Route("/logIn", name="user_log_in")
     */
    public function login(Request $request) {

        $username = $request->request->get('username');
        $hashedPass = $request->request->get('password');
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $authManager = new AuthManager($repository, $entityManager);
        return $this->json($authManager->logIn($username, $hashedPass));
    }

    /**
     * @Route("/logOut", name="user_log_out")
     */
    public function logout(Request $request) {

        $token = $request->headers->get('token');
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(AuthenticationTokens::class);
        $authManager = new AuthManager($repository, $entityManager);
        return $this->json($authManager->logOut($token));
    }

    /**
     * @Route("/info", name="user_info")
     */
    public function info(Request $request) {

        $token = $request->headers->get('token');
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $authManager = new AuthManager($repository);
        return $this->json($authManager->getUserInfo($token));
    }

}

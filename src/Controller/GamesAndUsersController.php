<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\GamesAndUsersManagement\GamesAndUsers\Lib\GamesAndUsersManager;
use Symfony\Component\HttpFoundation\Request;



class GamesAndUsersController extends CustomAbstractController
{
    /**
     * @Route("/{gameId}/user/insert", name="games_and_users_insert")
     */
    public function insertUserForGame($gameId, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $gamesAndUserManager = new GamesAndUsersManager(null, $entityManager);
        $userId = $request->request->get('userId');
        return $this->json($gamesAndUserManager->insertUserForSpecificGame($gameId, $userId));
    }
}

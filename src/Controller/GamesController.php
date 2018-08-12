<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Games;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\GameManagement\Game\Lib\GameManager;

class GamesController extends CustomAbstractController
{
    /**
     * @Route("/allGames", name="games")
     */
    public function getAllGames()
    {
        $repository = $this->getDoctrine()->getRepository(Games::class);
        $gameManager = new GameManager($repository);

        return $this->json([
            'Success' => 'GettingAllGames',
            'Msg' => $gameManager->getAllGames(),
        ]);
    }

    /**
     * @Route("/insertGame", name="insert_game")
     */
    public function insertGame(Request $request) {

        $isAdminLogged = $this->checkIfAdminIsLogged($request);

        if (isset($isAdminLogged['Error'])) {
            return $this->json($isAdminLogged);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $gameManager = new GameManager(null, $entityManager);
        $gameName = $request->request->get('gameName');
        return $this->json($gameManager->insertGame($gameName));

    }

}

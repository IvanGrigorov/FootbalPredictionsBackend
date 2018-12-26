<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Games;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\GameManagement\Game\Lib\GameManager;
use App\CoreLibs\PointSettingsManagement\PointSettings\Lib\PointSettingsManager;

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
        $gameInsertInfo = $gameManager->insertGame($gameName);
        // Default points for game
        $pointSettingsManager = new PointSettingsManager(null, $entityManager);
        $pointsArray = array(
            'PointsCorrectResult' => 5,
            'PointsCorrectFixture' =>  3,
            'PointsAmountOfGoals' => 0,
        );
        $pointSettingsManager->setPointSettingsForGame($gameInsertInfo['gameId'], json_encode($pointsArray));
        return $this->json($gameInsertInfo['info']);

    }

    /**
     * @Route("{gameId}/update/game", name="update_game")
     */
    public function updateGame($gameId, Request $request) {

        //$isAdminLogged = $this->checkIfAdminIsLogged($request);

        //if (isset($isAdminLogged['Error'])) {
        //    return $this->json($isAdminLogged);
        //}

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Games::class);
        $gameManager = new GameManager($repository, $entityManager);
        $gameName = $request->request->get('gameName');
        return $this->json($gameManager->updateGame($gameId, $gameName));

    }

}

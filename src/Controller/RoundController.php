<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\CoreLibs\GameManagement\Game\Lib\GameManager;
use App\CoreLibs\RoundManagement\Round\Lib\RoundManager;
use App\Entity\Games;
use App\Entity\Rounds;
use App\Controller\AbstractController\CustomAbstractController;




class RoundController extends CustomAbstractController
{
    /**
     * @Route("/round/create", name="round_create")
     */
    public function createRound(Request $request)
    {
        $isAdminLogged = $this->checkIfAdminIsLogged($request);

        if (isset($isAdminLogged['Error'])) {
            return $this->json($isAdminLogged);
        }
        
        // Move this in Round Manager maybe or maybe pass gameId as parameters
        $repository = $this->getDoctrine()->getRepository(Games::class);
        $gameManager = new GameManager($repository);
        $gameName = $request->request->get('gameName');
        $gameIdInfo = $gameManager->getGameIdByName($gameName);
        if (empty($gameIdInfo['GameId'])) {
            return $this->json(
                array(
                    'Error' => 'GetGameInfoError',
                    'Msg' => 'There is no such game'
                )
            );
        }

        $entityManager = $this->getDoctrine()->getManager();
        $roundManager = new RoundManager(null, $entityManager);
        $roundNumber = $request->request->get('roundNumber');

        return $this->json([
            'Success' => 'InsertNewRound',
            'Msg' => $roundManager->insertRound($gameIdInfo['GameId']['id'], $roundNumber)
        ]);

    }

    /**
     * @Route("/{game}/rounds", name="rounds_for_game")
     */
    public function getAllRoundsForGame($game, Request $request) {

        $repository = $this->getDoctrine()->getRepository(Rounds::class);
        $roundManager = new RoundManager($repository);

        return $this->json( $roundManager->getAllRoundsForGameId($game));

    }
}

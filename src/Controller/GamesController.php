<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Games;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\AbstractController\CustomAbstractController;

class GamesController extends CustomAbstractController
{
    /**
     * @Route("/allGames", name="games")
     */
    public function getAllGames()
    {
        $repository = $this->getDoctrine()->getRepository(Games::class);
        $allGames = $repository->findAllGames();
        $convertedGames = array();
        foreach($allGames as $game) {
            $convertedGames[] = $game->formatGame();
        }

        return $this->json([
            'Success' => 'GettingAllGames',
            'Msg' => $convertedGames,
        ]);
    }

    /**
     * @Route("/insertGame", name="insert_game")
     */
    public function insertGame(Request $request) {

        $isUserLogged = $this->checkForLoggedUser($request);
        if (isset($isUserLogged['Error'])) {
            return $this->json($isUserLogged);
        }

        $gameName = $request->request->get('gameName');
        $game = new Games();
        $game->setName($gameName);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($game);
        $entityManager->flush();
        return $this->json([
            'Success' => 'InsertingTheGame',
            'Msg' => 'The game '. $gameName . ' has been inserted successfully',
        ]);

    }

}

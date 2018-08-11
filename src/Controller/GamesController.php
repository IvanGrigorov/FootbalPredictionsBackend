<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Games;
use Symfony\Component\HttpFoundation\Request;




class GamesController extends Controller
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

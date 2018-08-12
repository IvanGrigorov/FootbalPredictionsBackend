<?php 

namespace App\CoreLibs\GameManagement\Game\Lib;
use \App\CoreLibs\GameManagement\Game\Interfaces\GameMngmntInterface;
use App\Entity\Games;




class GameManager implements GameMngmntInterface {
    
    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    public function getAllGames() {
        $allGames = $this->repo->findAllGames();
        $convertedGames = array();
        foreach($allGames as $game) {
            $convertedGames[] = $game->formatGame();
        }

        return array(
            'Success' => 'GettingAllGames',
            'Msg' => $convertedGames,
        );
    }

    public function insertGame($gameName) {
        $game = new Games();
        $game->setName($gameName);
        $this->entityMngr->persist($game);
        $this->entityMngr->flush();
        return array(
            'Success' => 'InsertingTheGame',
            'Msg' => 'The game '. $gameName . ' has been inserted successfully',
        );
    }


}
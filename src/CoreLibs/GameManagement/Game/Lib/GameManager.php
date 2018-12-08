<?php 

namespace App\CoreLibs\GameManagement\Game\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use \App\CoreLibs\GameManagement\Game\Interfaces\GameMngmntInterface;
use App\Entity\Games;




class GameManager extends AbstractManager implements GameMngmntInterface {
    
    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
    }

    public function getAllGames() {
        $allGames = $this->repo->findAllGames();
        //$convertedGames = array();
        //foreach($allGames as $game) {
        //    $convertedGames[] = $game->formatGame();
        //}

        return array(
            'Success' => 'GettingAllGames',
            'Msg' => $allGames,
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

    function getGameIdByName($gameName) {
        $gameId = $this->repo->findGameIdByGameName($gameName);
        return array(
            'Success' => 'GettingGameId',
            'GameId' => $gameId,
            'Msg' => 'The game Id has been gathered successfully',
        );    
    }

    function updateGame($gameId, $gameName) {
        $game = $this->repo->findGameById($gameId);
        $game->setName($gameName);
        $this->entityMngr->persist($game);
        $this->entityMngr->flush();
        return array(
            'Success' => 'UpdatingTheGame',
            'Msg' => 'The game '. $gameName . ' has been inserted successfully',
        );

    }

}
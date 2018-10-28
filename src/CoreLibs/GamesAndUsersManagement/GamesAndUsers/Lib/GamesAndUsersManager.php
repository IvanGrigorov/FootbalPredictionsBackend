<?php

namespace App\CoreLibs\GamesAndUsersManagement\GamesAndUsers\Lib;
use App\CoreLibs\GamesAndUsersManagement\GamesAndUsers\Interfaces\GamesAndUsersManagementInterface;
use App\Entity\GamesAndUsers;

class GamesAndUsersManager implements GamesAndUsersManagementInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    public function getAllUsersForGame($gameId) {
        $usersForGame = $this->repo->findAllUsersForGame($gameId);
        return array(
            'Success' => 'GetUsersForGame',
            'Msg' => $usersForGame,
        );
        
    }

    public function insertUserForSpecificGame($gameId, $userId) {
        $gamesAndUsers = new GamesAndUsers();
        $gamesAndUsers->setGameId($gameId);
        $gamesAndUsers->setUserId($userId);
        $this->entityMngr->persist($gamesAndUsers);
        $this->entityMngr->flush();  
        return array(
            'Success' => 'SetUserForGameSuccessfuly',
            'Msg' => 'UserForGameSetSuccess',
        );    
    }
}
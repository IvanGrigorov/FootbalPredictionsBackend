<?php

namespace App\CoreLibs\GamesAndUsersManagement\GamesAndUsers\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\GamesAndUsersManagement\GamesAndUsers\Interfaces\GamesAndUsersManagementInterface;
use App\Entity\GamesAndUsers;

class GamesAndUsersManager extends AbstractManager implements GamesAndUsersManagementInterface {

    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
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
            'Msg' => 'User added in the game',
        );    
    }

    public function isUserPartOfTheGame($gameId, $userId) {
        $usersForGame = $this->repo->getUserIFExists($gameId, $userId);
        if ($usersForGame) {
            true;
        }
        else {
            false;
        }
        
    }
}
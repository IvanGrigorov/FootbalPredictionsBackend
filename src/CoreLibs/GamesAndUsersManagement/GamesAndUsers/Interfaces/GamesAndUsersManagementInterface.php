<?php

namespace App\CoreLibs\GamesAndUsersManagement\GamesAndUsers\Interfaces;

interface GamesAndUsersManagementInterface {

    function getAllUsersForGame($gameId);

    public function insertUserForSpecificGame($gameId, $userId);

    public function isUserPartOfTheGame($gameId, $userId);
    
}
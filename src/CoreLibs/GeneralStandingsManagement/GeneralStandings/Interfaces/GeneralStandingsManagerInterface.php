<?php

namespace App\CoreLibs\GeneralStandingsManagement\GeneralStandings\Interfaces;

interface GeneralStandingsManagerInterface {

    function getCurrentGeneralStandingsForUser($gameId, $userId); 

    function updateGeneralStandingsForUser($generalStandingsForUser, $gameId, $userId, $points);
    
}
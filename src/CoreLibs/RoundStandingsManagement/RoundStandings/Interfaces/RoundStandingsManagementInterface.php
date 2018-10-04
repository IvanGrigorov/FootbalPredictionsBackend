<?php

namespace App\CoreLibs\RoundStandingsManagement\RoundStandings\Interfaces;

interface RoundStandingsManagementInterface {

    function getRoundStandingsForAllUsers($roundId);

    function getRoundStandingsForSpecificUser($roundId, $userId);
    
}
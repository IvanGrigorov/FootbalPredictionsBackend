<?php

namespace App\CoreLibs\RoundTeamsManagement\RoundTeams\Interfaces;

interface RoundTeamsManagerInterface {

    function insertRoundTeams($host, $guest, $roundId);

    public function getRoundTeamsForRound($roundId);

    public function insertTeamsForRound($roundId, $teamsJSON);
    
}
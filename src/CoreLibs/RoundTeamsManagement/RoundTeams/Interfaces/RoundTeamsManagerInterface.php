<?php

namespace App\CoreLibs\RoundTeamsManagement\RoundTeams\Interfaces;

interface RoundTeamsManagerInterface {

    function insertRoundTeams($host, $guest, $roundId);
    
}
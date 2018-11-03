<?php

namespace App\CoreLibs\GenerationStandingsManagement\GenerationStandings\Interfaces;

interface GenerationStandingsManagementInterface {

    public function generateStandings($gameId, $roundId);
        
}
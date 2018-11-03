<?php

namespace App\CoreLibs\RoundGenerationStatusManagement\RoundGenerationStatus\Interfaces;

interface RoundGenerationStatusManagerInterface {

    public function setStatusForRound($roundId);
    
    public function getStatusForRound($roundId);
    
}
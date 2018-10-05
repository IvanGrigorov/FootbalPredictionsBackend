<?php

namespace App\CoreLibs\PredictionsManagement\Predictions\Interfaces;

interface PredictionsManagementInterface {

    function insertMultiplePredictions($predictionsJSON, $roundId, $userId);
    
    public function getPredictionsForRound($roundId);
    
}
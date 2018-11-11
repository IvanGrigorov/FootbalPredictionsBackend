<?php

namespace App\CoreLibs\PredictionsSettingsManagement\PredictionsSettings\Interfaces;

interface PredictionsSettingsManagerInterface {

    public function setPredictionsSettingsForRound($roundId, $untilDate);

    public function updatePredictionsSettingsForRound($roundId, $untilDate);

    public function getPredictionsSettingsForRound($roundId);
        
}
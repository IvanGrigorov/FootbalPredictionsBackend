<?php

namespace App\CoreLibs\PredictionsSettingsManagement\PredictionsSettings\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\PredictionsSettingsManagement\PredictionsSettings\Interfaces\PredictionsSettingsManagerInterface;
use App\Entity\PredictionSettings;

class PredictionsSettingsManager extends AbstractManager implements PredictionsSettingsManagerInterface {

    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
    }

    public function setPredictionsSettingsForRound($roundId, $untilDate) {
        $predictionSettings = new PredictionSettings();
        $predictionSettings->setRoundId($roundId);
        $predictionSettings->setUntil($untilDate);
        $this->entityMngr->persist($predictionSettings);
        $this->entityMngr->flush();
        return array(
            'Success' => 'SetPredictionsSettingsForGameSuccess',
            'Msg' => 'Predictions Settings for round ' . $roundId . ' is successfull'
        );
    }

    public function updatePredictionsSettingsForRound($roundId, $untilDate){
        $currentPredictionsInfo = $this->getPredictionsSettingsForRound($roundId);
        $currentPredictionsInfo['Msg']->setUntil($untilDate);
        $this->entityMngr->persist($currentPredictionsInfo['Msg']);
        $this->entityMngr->flush();
        return array(
            'Success' => 'SetPredictionsSettingsForGameSuccess',
            'Msg' => 'Predictions Settings Update for round ' . $roundId . ' is successfull'
        );
    }

    public function getPredictionsSettingsForRound($roundId){
        $predictionsSettingsInfo = $this->repo->getPredictionsSettingsInfo($roundId);
        return array(
            'Success' => 'GetPredictionsSettingsInfoSuccess',
            'Msg' => $predictionsSettingsInfo
        );        
    }
}
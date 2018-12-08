<?php

namespace App\CoreLibs\PredictionsManagement\Predictions\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\PredictionsManagement\Predictions\Interfaces\PredictionsManagementInterface;
use App\Entity\Predictions;


class PredictionsManager extends AbstractManager implements PredictionsManagementInterface {

    private $predictionsSettingsManager;

    function __construct($repository, $entityManager = null, $predictionsSettingsManager = null) {
        parent::__construct($repository, $entityManager);
        $this->predictionsSettingsManager = $predictionsSettingsManager;

    }

    
    private function insertPrediction($host, $guest, $roundId, $roundTeamsId, $userId) {
        $prediction = new Predictions();
        $prediction->setRoindId($roundId);
        $prediction->setUserId($userId);
        $prediction->setHost($host);
        $prediction->setGuest($guest);
        $prediction->setRoundTeamsId($roundTeamsId);
        $this->entityMngr->persist($prediction);
        $this->entityMngr->flush();

    }

    function insertMultiplePredictions($predictionsJSON, $roundId, $userId) {
        $predictionSettingsInfo = $this->predictionsSettingsManager->getPredictionsSettingsForRound($roundId);
        $predictionsUntil = $predictionSettingsInfo['Msg']->getUntil();
        date_default_timezone_set('Europe/Sofia');
        $date = date("d-m-Y H:i:s");
        if (date_create($date) > date_create($predictionsUntil)) {
            return array(
                'Error' => 'SetPredictionsError',
                'Msg' => 'You are late with your predictions. The deadline was ' . $predictionsUntil,
            );
        }
        $predictions = json_decode($predictionsJSON, true);
        foreach($predictions as $prediction) {
            $this->insertPrediction($prediction['host'], $prediction['guest'], $roundId, $prediction['roundTeamsId'], $userId);
        }
        return array(
            'Success' => 'SetPredictionsSuccessfuly',
            'Msg' => 'PredictionsSetSuccess',
        );
    }

    public function getPredictionsForRound($roundId) {
        $predictions = $this->repo->findPredictionsByRoundId($roundId);
        return array(
            'Success' => 'GetPredictionsForRound',
            'Msg' => $predictions,
        );
    }

    public function getPredictionForRoundByUserId($userId, $roundId) {
        $predictions = $this->repo->findPredictionsForRoundByUserId($roundId, $userId);
        return array(
            'Success' => 'GetPredictionForRoundByUserId',
            'Msg' => $predictions,
        );
    }

    public function updatePredictions($roundId, $predictionsId, $hostResult, $guestResult) {
        $arePredictionsLate = $this->checkIfPredictionsAreLate($roundId);
        if ($arePredictionsLate) {
            return $arePredictionsLate;
        }
        $predictionsById = $this->repo->findPredictionsForRoundById($predictionsId);
        $predictionsById->setHost($hostResult);
        $predictionsById->setGuest($guestResult);
        $this->entityMngr->persist($predictionsById);
        $this->entityMngr->flush();
        return array(
            'Success' => 'UpdatePredictionsSuccessfuly',
            'Msg' => 'PredictionsUpdateSuccess',
        );
    }

    private function checkIfPredictionsAreLate($roundId) {
        $predictionSettingsInfo = $this->predictionsSettingsManager->getPredictionsSettingsForRound($roundId);
        $predictionsUntil = $predictionSettingsInfo['Msg']->getUntil();
        date_default_timezone_set('Europe/Sofia');
        $date = date("d-m-Y H:i:s");
        if (date_create($date) > date_create($predictionsUntil)) {
            return array(
                'Error' => 'SetPredictionsError',
                'Msg' => 'You are late with your predictions. The deadline was ' . $predictionsUntil,
            );
        }
        return false;
    }


        //$realResultsDecoded = json_decode($realResultsJSON, true);
        //foreach ($realResultsDecoded as $realResultsObject) {
        //    $realResults = new RealResults();
        //    $realResults->setRoundTeamsId($realResultsObject['roundTeamsId']);
        //    $realResults->setHost($realResultsObject['host']);
        //    $realResults->setGuest($realResultsObject['guest']);
        //    $this->entityMngr->persist($realResults);
        //    $this->entityMngr->flush();
        //}
        //return array(
        //    'Success' => 'InsertingRealResults',
        //    'Msg' => 'The realResults have been inserted successfully',
        //);

}
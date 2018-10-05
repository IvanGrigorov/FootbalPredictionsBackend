<?php

namespace App\CoreLibs\PredictionsManagement\Predictions\Lib;
use App\CoreLibs\PredictionsManagement\Predictions\Interfaces\PredictionsManagementInterface;
use App\Entity\Predictions;


class PredictionsManager implements PredictionsManagementInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
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
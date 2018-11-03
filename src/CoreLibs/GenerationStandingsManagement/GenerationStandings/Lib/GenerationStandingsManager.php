<?php

namespace App\CoreLibs\GenerationStandingsManagement\GenerationStandings\Lib;
use App\CoreLibs\GenerationStandingsManagement\GenerationStandings\Interfaces\GenerationStandingsManagementInterface;
use App\Entity\Predictions;




class GenerationStandingsManager implements GenerationStandingsManagementInterface {

    private $repo;
    private $entityMngr;
    private $gameAndUsersManager;
    private $predictionsManager;
    private $realResultsManager;
    private $roundStandingsManager;
    private $generalStandingsManager;
    private $roundGenerationStatusManager;

    //function __construct($authManager, $gameAndUsersManager, $repostory, $entityManager = null) {
    function __construct($gameAndUsersManager, $predictionsManager, $realResultsManager, $roundStandingsManager, $generalStandingsManager, $roundGenerationStatusManager, $repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
        $this->gameAndUsersManager = $gameAndUsersManager;
        $this->predictionsManager = $predictionsManager;
        $this->realResultsManager = $realResultsManager;
        $this->roundStandingsManager = $roundStandingsManager;
        $this->generalStandingsManager = $generalStandingsManager;
        $this->roundGenerationStatusManager = $roundGenerationStatusManager;

    }

    public function generateStandings($gameId, $roundId) {
        $roundStatus =  $this->roundGenerationStatusManager->getStatusForRound($roundId);

        if (!empty($roundStatus['Msg'])) {
            return array(
                'Error' => 'GenerateStandingsError',
                'Msg' => 'Standings for round ' . $roundId . ' already generated'
            );
        }

        $getAllUsersForGame = $this->gameAndUsersManager->getAllUsersForGame($gameId);
        
        return array(
            'Success' => 'GenerateStandingsSuccess',
            'Msg' => $this->generate($gameId, $getAllUsersForGame['Msg'], $roundId)
        );
    }

    private function generate($gameId, $userIdCollections, $roundId) {

        $realResultsForRound = $this->getRealResultsForRound($roundId);
        foreach($userIdCollections as $userInfo) {
            $predictionsInfo[$userInfo['UserId']] = $this->predictionsManager->getPredictionForRoundByUserId($userInfo['UserId'], $roundId);
            $userRoundPointsInfo = 0;
            foreach($realResultsForRound['Msg'] as $realResult) {
               foreach($predictionsInfo[$userInfo['UserId']]['Msg'] as $userPredictions) {
                   if ($realResult['RoundTeamsId'] == $userPredictions['RoundTeamsId']) {
                       $userRoundPointsInfo += $this->calculatePointsForMatch($realResult, $userPredictions);
                       break;
                   }
               }
            }
            $this->roundStandingsManager->uploadRoundStandingsForSpecificUser($roundId, $userInfo['UserId'], $userRoundPointsInfo);
            $generalStandingsForUser = $this->generalStandingsManager->getCurrentGeneralStandingsForUser($gameId, $userInfo['UserId']);
            $this->generalStandingsManager->updateGeneralStandingsForUser($generalStandingsForUser, $gameId, $userInfo['UserId'], $userRoundPointsInfo);
        }
        $this->roundGenerationStatusManager->setStatusForRound($roundId);
        return array(
            'Success' => 'GenerateStandingsSuccessForUsers',
            'Msg' => 'Successfully generated Results'
        );
    }

    private function getRealResultsForRound($roundId) {
        $realResults = $this->realResultsManager->getRealResultsForRound($roundId);
        return $realResults;
    }

    private function calculatePointsForMatch($realResultsInfo, $userPredictionsInfo) {
        if (($realResultsInfo['Host'] == $userPredictionsInfo['Host']) && 
            ($realResultsInfo['Guest'] == $userPredictionsInfo['Guest'])) {
                return 3;
        }
        else if ( ($realResultsInfo['Host'] < $realResultsInfo['Guest']) && 
                ($userPredictionsInfo['Host'] < $userPredictionsInfo['Guest']) ) {
                return 1;
        }
        else if ( ($realResultsInfo['Host'] > $realResultsInfo['Guest']) && 
                ($userPredictionsInfo['Host'] > $userPredictionsInfo['Guest']) ) {
                return 1;
        }
        else if ( ($realResultsInfo['Host'] == $realResultsInfo['Guest']) && 
                ($userPredictionsInfo['Host'] == $userPredictionsInfo['Guest']) ) {
                return 1;
        }
    }

}
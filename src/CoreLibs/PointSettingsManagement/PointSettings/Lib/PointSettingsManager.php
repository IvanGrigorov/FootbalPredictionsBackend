<?php

namespace App\CoreLibs\PointSettingsManagement\PointSettings\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\PointSettingsManagement\PointSettings\Interfaces\PointSettingsManagerInterface;
use App\Entity\PointSettings;

class PointSettingsManager extends AbstractManager implements PointSettingsManagerInterface {

    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
    }

    public function setPointSettingsForGame($gameId, $pointSettingsJSON) {
        $pointsInfo = json_decode($pointSettingsJSON, true);
        $pointsSettings = new PointSettings();
        $pointsSettings->setGameId($gameId);
        $pointsSettings->setPointsCorrectResult($pointsInfo['PointsCorrectResult']);
        $pointsSettings->setPointsCorrectFixture($pointsInfo['PointsCorrectFixture']);
        $pointsSettings->setPointsAmountOfGoals($pointsInfo['PointsAmountOfGoals']);
        $this->entityMngr->persist($pointsSettings);
        $this->entityMngr->flush();
        return array(
            'Success' => 'SetPointSettingsForGameSuccess',
            'Msg' => 'Point Settings for game ' . $gameId . ' is successfull'
        );
    }

    public function updatePointSettingsForGame($gameId, $pointSettingsJSON){
        $currentPointInfo = $this->getPointSettingsForGame($gameId);
        $pointsInfo = json_decode($pointSettingsJSON, true);
        $currentPointInfo['Msg']->setGameId($gameId);
        $currentPointInfo['Msg']->setPointsCorrectResult($pointsInfo['PointsCorrectResult']);
        $currentPointInfo['Msg']->setPointsCorrectFixture($pointsInfo['PointsCorrectFixture']);
        $currentPointInfo['Msg']->setPointsAmountOfGoals($pointsInfo['PointsAmountOfGoals']);
        $this->entityMngr->persist($currentPointInfo['Msg']);
        $this->entityMngr->flush();
        return array(
            'Success' => 'SetPointSettingsForGameSuccess',
            'Msg' => 'Point Settings Update for game ' . $gameId . ' is successfull'
        );
    }

    public function getPointSettingsForGame($gameId){
        $pointSettingsInfo = $this->repo->getPointSettingsInfo($gameId);
        return array(
            'Success' => 'GetPointSettingsInfoSuccess',
            'Msg' => $pointSettingsInfo
        );        
    }
}
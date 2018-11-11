<?php

namespace App\CoreLibs\GeneralStandingsManagement\GeneralStandings\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\GeneralStandingsManagement\GeneralStandings\Interfaces\GeneralStandingsManagerInterface;
use App\Entity\Standings;

class GeneralStandingsManager extends AbstractManager implements GeneralStandingsManagerInterface {

    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
    }

    public function getCurrentGeneralStandingsForUser($gameId, $userId) {
        $userStandingsInfo = $this->repo->getGeneralStandingsForUser($gameId, $userId);
        return array(
            'Success' => 'GetCurrentStandingsSuccess',
            'Msg' => $userStandingsInfo
        );
    }

    public function getCurrentGeneralStandingsForGame($gameId) {
        $gameStandingsInfo = $this->repo->getGeneralStandingsForGame($gameId);
        return array(
            'Success' => 'GetCurrentStandingsForGameSuccess',
            'Msg' => $gameStandingsInfo
        );
    }

    function updateGeneralStandingsForUser($generalStandingsForUser, $gameId, $userId, $points) {
        if (empty($generalStandingsForUser['Msg'])) {
            $generalStandingsForUser['Msg'] = new Standings();
            $generalStandingsForUser['Msg']->setGameId($gameId);
            $generalStandingsForUser['Msg']->setUserId($userId);
            $generalStandingsForUser['Msg']->setPoints($points);
            $this->entityMngr->persist($generalStandingsForUser['Msg']);
        }
        else {
            $currentPoints = $generalStandingsForUser['Msg']->getPoints();
            $updatedPoints = $currentPoints + $points;
            $generalStandingsForUser['Msg']->setPoints($updatedPoints);
        }
        $this->entityMngr->flush();
        
    }



}
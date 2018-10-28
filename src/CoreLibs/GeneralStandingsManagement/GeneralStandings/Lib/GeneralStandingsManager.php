<?php

namespace App\CoreLibs\GeneralStandingsManagement\GeneralStandings\Lib;
use App\CoreLibs\GeneralStandingsManagement\GeneralStandings\Interfaces\GeneralStandingsManagerInterface;
use App\Entity\Standings;

class GeneralStandingsManager implements GeneralStandingsManagerInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    public function getCurrentGeneralStandingsForUser($gameId, $userId) {
        $userStandingsInfo = $this->repo->getGeneralStandingsForUser($gameId, $userId);
        return array(
            'Success' => 'GetCurrentStandingsSuccess',
            'Msg' => $userStandingsInfo
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
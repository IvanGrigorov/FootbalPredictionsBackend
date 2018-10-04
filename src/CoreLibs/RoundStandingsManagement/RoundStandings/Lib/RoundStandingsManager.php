<?php

namespace App\CoreLibs\RoundStandingsManagement\RoundStandings\Lib;
use App\CoreLibs\RoundStandingsManagement\RoundStandings\Interfaces\RoundStandingsManagementInterface;
use App\Entity\RoundStandings;

class RoundStandingsManager implements RoundStandingsManagementInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    function getRoundStandingsForAllUsers($roundId) {
        $allStandingsForUsers = $this->repo->getRoundStandingsForAllUsers($roundId);
        $convertedStandings = array();
        foreach($allStandingsForUsers as $standings) {
            $standing = $standings[0]->formatRoundStandings();
            $standing['username'] = $standings['name'];
            $convertedStandings[] = $standing;
        }

        return array(
            'Success' => 'GettingAllRoundStandings',
            'Msg' => $convertedStandings,
        );
    }

    function getRoundStandingsForSpecificUser($roundId, $userId) {
        $allStandingsForSpecificUsers = $this->repo->getRoundStandingsForSpecificUser($roundId, $userId);
        $convertedStandings = $this->convertDataFromDBToArray($allStandingsForSpecificUsers);

        return array(
            'Success' => 'GettingRoundStandingsForSpecificUser',
            'Msg' => $convertedStandings,
        );
    }

    function uploadRoundStandingsForSpecificUser($roundId, $userId, $points) {

        $roundStandings = new RoundStandings();
        $roundStandings->setRoundId($roundId);
        $roundStandings->setUserId($userId);
        $roundStandings->setPoints($points);
        $this->entityMngr->persist($roundStandings);
        $this->entityMngr->flush();
        return array(
            "Success" => "UploadRoundStandingsForUser",
            "Msg" => "Successfully uploaded standings for user"
        );


    }

    // Move in abstract class
    private function convertDataFromDBToArray($standingsArray) {
        $convertedStandings = array();
        foreach($standingsArray as $standings) {
            $standing = $standings[0]->formatRoundStandings();
            $standing['username'] = $standings['name'];
            $convertedStandings[] = $standing;
        }
        return $convertedStandings;
    }


}
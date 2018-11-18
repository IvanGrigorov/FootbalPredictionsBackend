<?php

namespace App\CoreLibs\RoundTeamsManagement\RoundTeams\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\RoundTeamsManagement\RoundTeams\Interfaces\RoundTeamsManagerInterface;
use App\Entity\RoundTeams;

class RoundTeamsManager extends AbstractManager implements RoundTeamsManagerInterface {


    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
    }

    public function insertRoundTeams($host, $guest, $roundId) {

        $roundTeams = new RoundTeams();
        $roundTeams->setHost($host);
        $roundTeams->setGuest($guest);
        $roundTeams->setRoundId($roundId);
        $this->entityMngr->persist($roundTeams);
        $this->entityMngr->flush();
        return array(
            'Success' => 'InsertingRoundTeams',
            'Msg' => 'The round teams has been inserted successfully',
        );

    }

    public function getRoundTeamsForRound($roundId) {
        $allTeamsForRound = $this->repo->findAllTeamsForRound($roundId);
        $convertedTeams = array();
        foreach($allTeamsForRound as $team) {
            $convertedTeams[] = $team->formatTeam();
        }

        return array(
            'Success' => 'GettingAllGames',
            'Msg' => $convertedTeams,
        );
    }

    public function insertTeamsForRound($roundId, $teamsJSON) {
        
    }
}
<?php

namespace App\CoreLibs\RoundManagement\Round\Lib;
use App\CoreLibs\RoundManagement\Round\Interfaces\RoundInterface;
use App\Entity\Rounds;


class RoundManager implements RoundInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    
    public function insertRound($gameId, $roundNumber) {

        $round = new Rounds();
        $round->setGamesId($gameId);
        $round->setRoundNumber($roundNumber);
        $this->entityMngr->persist($round);
        $this->entityMngr->flush();
        return array(
            'Success' => 'InsertingRound',
            'Msg' => 'The round has been inserted successfully',
        );

    }

    
    public function getAllRoundsForGameId($gameId) {
        $allRoundsForGameId = $this->repo->findAllRoundsForGameId($gameId);
        $convertedRounds = array();
        foreach($allRoundsForGameId as $round) {
            $convertedRounds[] = $round->formatRound();
        }

        return array(
            'Success' => 'GettingAllGames',
            'Msg' => $convertedRounds,
        );
    }

}
<?php

namespace App\CoreLibs\RoundManagement\Round\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\RoundManagement\Round\Interfaces\RoundInterface;
use App\Entity\Rounds;


class RoundManager extends AbstractManager implements RoundInterface {


    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
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
        //$convertedRounds = array();
        //foreach($allRoundsForGameId as $round) {
        //    $convertedRounds[] = $round->formatRound();
        //}

        return array(
            'Success' => 'GettingAllRounds',
            //'Msg' => $convertedRounds,
            'Msg' => $allRoundsForGameId,

        );
    }

}
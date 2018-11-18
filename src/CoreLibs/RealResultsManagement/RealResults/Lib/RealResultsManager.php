<?php

namespace App\CoreLibs\RealResultsManagement\RealResults\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\RealResultsManagement\RealResults\Interfaces\RealResultsManagementInterface;
use App\Entity\RealResults;


class RealResultsManager extends AbstractManager implements RealResultsManagementInterface {


    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
    }

    
    public function insertRealResults($realResultsJSON) {

        $realResultsDecoded = json_decode($realResultsJSON, true);
        foreach ($realResultsDecoded as $realResultsObject) {
            $realResults = new RealResults();
            $realResults->setRoundTeamsId($realResultsObject['roundTeamsId']);
            $realResults->setHost($realResultsObject['host']);
            $realResults->setGuest($realResultsObject['guest']);
            $this->entityMngr->persist($realResults);
            $this->entityMngr->flush();
        }
        return array(
            'Success' => 'InsertingRealResults',
            'Msg' => 'The realResults have been inserted successfully',
        );

    }

    public function getRealResultsForRound($roundId) {
        $realResults = $this->repo->getRealResultsForRoundId($roundId);
        return array(
            'Success' => 'GettingRealResultsForRound',
            'Msg' => $realResults,
        );
    }

}
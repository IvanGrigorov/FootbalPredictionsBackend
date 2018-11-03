<?php

namespace App\CoreLibs\RoundGenerationStatusManagement\RoundGenerationStatus\Lib;
use App\CoreLibs\RoundGenerationStatusManagement\RoundGenerationStatus\Interfaces\RoundGenerationStatusManagerInterface;
use App\Entity\RoundGenerationStatus;




class RoundGenerationStatusManager implements RoundGenerationStatusManagerInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    public function setStatusForRound($roundId) {
        $roundStatus = new RoundGenerationStatus();
        $roundStatus->setRoundId($roundId);
        $roundStatus->setStatus('COMPLETED');
        $this->entityMngr->persist($roundStatus);
        $this->entityMngr->flush();
        return array(
            'Success' => 'SetStatusForRoundSuccess',
            'Msg' => 'Status for round '. $roundId .' set sucessfully.'
        );
    }

    public function getStatusForRound($roundId) {
        $roundStatus = $this->repo->findStatusByRoundId($roundId);
        return array(
            'Success' => 'GetStatusForRoundSuccess',
            'Msg' => $roundStatus
        );
    }
}
<?php

namespace App\CoreLibs\RoundGenerationStatusManagement\RoundGenerationStatus\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\RoundGenerationStatusManagement\RoundGenerationStatus\Interfaces\RoundGenerationStatusManagerInterface;
use App\Entity\RoundGenerationStatus;




class RoundGenerationStatusManager extends AbstractManager implements RoundGenerationStatusManagerInterface {


    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
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
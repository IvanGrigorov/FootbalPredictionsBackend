<?php

namespace App\CoreLibs\RoundSettingsManagement\RoundSettings\Lib;
use App\CoreLibs\RoundSettingsManagement\RoundSettings\Interfaces\RoundSettingsManagementInterface;
use App\Entity\RoundSettings;

class RoundSettingsManager implements RoundSettingsManagementInterface {

    private $repo;
    private $entityMngr;


    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

    public function insertRoundSettings($until, $roundId) {

        $roundSettings = new RoundSettings();
        $roundSettings->setUntil($until);
        $roundSettings->setRoundId($roundId);
        $this->entityMngr->persist($roundSettings);
        $this->entityMngr->flush();
        return array(
            'Success' => 'InsertingRoundSettings',
            'Msg' => 'The round settings has been inserted successfully',
        );

    }
}
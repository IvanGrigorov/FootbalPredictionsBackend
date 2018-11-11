<?php

namespace App\CoreLibs\RoundSettingsManagement\RoundSettings\Lib;
use App\CoreLibs\AbstractManagement\AbstractManager;
use App\CoreLibs\RoundSettingsManagement\RoundSettings\Interfaces\RoundSettingsManagementInterface;
use App\Entity\RoundSettings;

class RoundSettingsManager extends AbstractManager implements RoundSettingsManagementInterface {


    function __construct($repository, $entityManager = null) {
        parent::__construct($repository, $entityManager);
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
<?php

namespace App\CoreLibs\RoundSettingsManagement\RoundSettings\Interfaces;

interface RoundSettingsManagementInterface {

    function insertRoundSettings($until, $roundId);
    
}
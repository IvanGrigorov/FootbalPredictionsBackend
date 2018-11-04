<?php

namespace App\CoreLibs\PointSettingsManagement\PointSettings\Interfaces;

interface PointSettingsManagerInterface {

    public function setPointSettingsForGame($gameId, $pointSettingsJSON);

    public function updatePointSettingsForGame($gameId, $pointSettingsJSON);

    public function getPointSettingsForGame($gameId);
        
}
<?php

namespace App\CoreLibs\RoundManagement\Round\Interfaces;

interface RoundInterface {

    public function insertRound($gameId, $roundNumber);
}
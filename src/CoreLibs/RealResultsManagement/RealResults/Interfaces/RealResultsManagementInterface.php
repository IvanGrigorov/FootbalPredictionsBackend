<?php

namespace App\CoreLibs\RealResultsManagement\RealResults\Interfaces;



interface RealResultsManagementInterface {
    
    public function insertRealResults($realResultsJSON, $roundId);
}

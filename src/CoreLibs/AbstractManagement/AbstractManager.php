<?php

namespace App\CoreLibs\AbstractManagement; 

abstract class AbstractManager {

    protected $repo;
    protected $entityMngr;

    function __construct($repostory, $entityManager = null) {
        $this->repo = $repostory;
        $this->entityMngr = $entityManager;
    }

}

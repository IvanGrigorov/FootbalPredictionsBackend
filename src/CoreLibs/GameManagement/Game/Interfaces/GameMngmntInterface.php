<?php

namespace App\CoreLibs\GameManagement\Game\Interfaces;

interface GameMngmntInterface {

    function getAllGames();

    function insertGame($gameName);

    function getGameIdByName($gameName);

}
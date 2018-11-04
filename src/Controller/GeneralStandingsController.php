<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\GeneralStandingsManagement\GeneralStandings\Lib\GeneralStandingsManager;
use App\Entity\Standings;


class GeneralStandingsController extends CustomAbstractController
{
    /**
     * @Route("{gameId}/general/standings", name="general_standings")
     */
    public function index($gameId)
    {
        $generalStandingsRepository = $this->getDoctrine()->getRepository(Standings::class);
        $generalStandingsManager = new GeneralStandingsManager($generalStandingsRepository);
        return $this->json($generalStandingsManager->getCurrentGeneralStandingsForGame($gameId));
    }
}

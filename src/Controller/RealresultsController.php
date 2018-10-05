<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\CoreLibs\RealResultsManagement\RealResults\Lib\RealResultsManager;



class RealresultsController extends CustomAbstractController
{
    /**
     * @Route("/results/real", name="realresults_insert", methods={"POST"})
     */
    public function setRealResultsForRound($roundTeams, Request $request)
    {
        $roundTeamsId = $roundTeams;
        $resultsJSON = $request->request->get("results");
        $entityManager = $this->getDoctrine()->getManager();
        $realResultsManager = new RealResultsManager(null, $entityManager);
        return $this->json($realResultsManager->insertRealResults($resultsJSON));
    }
}

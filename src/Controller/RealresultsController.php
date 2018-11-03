<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\CoreLibs\RealResultsManagement\RealResults\Lib\RealResultsManager;
use App\Entity\RealResults;




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

    /**
     * @Route("{roundId}/results/real", name="realresults_get", methods={"GET"})
     */
    public function getRealResultsForRound($roundId)
    {
        $repository = $this->getDoctrine()->getRepository(RealResults::class);
        $realResultsManager = new RealResultsManager($repository);
        return $this->json($realResultsManager->getRealResultsForRound($roundId));
    }
}

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
     * @Route("{roundId}/results/real", name="realresults_insert", methods={"POST"})
     */
    public function setRealResultsForRound($roundId, Request $request)
    {
        $resultsJSON = $request->request->get("results");
        $entityManager = $this->getDoctrine()->getManager();
        $realResultsManager = new RealResultsManager(null, $entityManager);
        return $this->json($realResultsManager->insertRealResults($resultsJSON, $roundId));
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

    /**
     * @Route("{realResultsId}/results/update", name="realresults_update", methods={"POST"})
     */
    public function updateRealResultsForId($realResultsId, Request $request)
    {
        $hostResult = $request->request->get("hostResult");
        $guestResult = $request->request->get("guestResult");
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(RealResults::class);
        $realResultsManager = new RealResultsManager($repository, $entityManager);
        return $this->json($realResultsManager->updateRealResultsForRound($realResultsId, $hostResult, $guestResult));
    }
}

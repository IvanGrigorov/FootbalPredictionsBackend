<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\CoreLibs\RoundStandingsManagement\RoundStandings\Lib\RoundStandingsManager;
use App\Entity\RoundStandings;


class RoundStandingsController extends CustomAbstractController
{
    /**
     * @Route("/{round}/standings", name="round_standings")
     */
    public function getRoundStandingsForAllUsers($round, Request $request)
    {
        $roundId = $round;
        $repository = $this->getDoctrine()->getRepository(RoundStandings::class);
        $roundStandingsManager = new RoundStandingsManager($repository);
        return $this->json($roundStandingsManager->getRoundStandingsForAllUsers($roundId));
    }

    /**
     * @Route("/{round}/{user}/standings", name="read_round_standings_for_user", methods={"GET"})
     */
    public function getRoundStandingsForSpecificUser($round, $user) {
        $roundId = $round;
        $userId = $user;
        $repository = $this->getDoctrine()->getRepository(RoundStandings::class);
        $roundStandingsManager = new RoundStandingsManager($repository);
        return $this->json($roundStandingsManager->getRoundStandingsForSpecificUser($roundId, $userId));
    }

    /**
     * @Route("/{round}/{user}/standings", name="upload_round_standings_for_user", methods={"POST"})
     */
    public function uploadRoundStandingsForSpecificUser($round, $user, Request $request) {
        $roundId = $round;
        $userId = $user;
        $points = $request->request->get("points");
        $entityManager = $this->getDoctrine()->getManager();
        $roundStandingsManager = new RoundStandingsManager(null, $entityManager);
        return $this->json($roundStandingsManager->uploadRoundStandingsForSpecificUser($roundId, $userId, $points));



    }
}

<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\CoreLibs\RoundTeamsManagement\RoundTeams\Lib\RoundTeamsManager;
use App\Entity\RoundTeams;




class RoundTeamsController extends CustomAbstractController
{
    /**
     * @Route("/{round}/teams/insert", name="round_teams_insert")
     */
    public function insertRoundTeams($round, Request $request)
    {

        //$isAdminLogged = $this->checkIfAdminIsLogged($request);

        //if (isset($isAdminLogged['Error'])) {
        //    return $this->json($isAdminLogged);
        //}

        $host = $request->request->get('host');
        $guest = $request->request->get('guest');
        $roundId = $round;

        $entityManager = $this->getDoctrine()->getManager();
        $roundTeamsManager = new RoundTeamsManager(null, $entityManager);

        return $this->json($roundTeamsManager->insertRoundTeams($host, $guest, $roundId));
    }

    /**
     * @Route("{round}/teams/", name="round_teams")
     */
    public function getTeamsForRound($round, Request $request) {
        $roundId = $round;
        $repository = $this->getDoctrine()->getRepository(RoundTeams::class);
        $roundTeamsManager = new RoundTeamsManager($repository);
        return $this->json($roundTeamsManager->getRoundTeamsForRound($roundId));



    }

    /**
     * @Route("{roundTeamsId}/teams/update", name="round_teams_update")
     */
    public function updateTeamsForRound($roundTeamsId, Request $request) {
        $repository = $this->getDoctrine()->getRepository(RoundTeams::class);
        
        $host = $request->request->get('host');
        $guest = $request->request->get('guest');

        $entityManager = $this->getDoctrine()->getManager();
        $roundTeamsManager = new RoundTeamsManager($repository, $entityManager);
        return $this->json($roundTeamsManager->updateRoundTeamsForRound($roundTeamsId, $host, $guest));



    }

}

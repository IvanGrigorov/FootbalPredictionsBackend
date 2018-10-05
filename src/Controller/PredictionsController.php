<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\AuthenticationTokens;
use App\CoreLibs\AuthManagement\Auth\Lib\AuthManager;
use App\CoreLibs\PredictionsManagement\Predictions\Lib\PredictionsManager;
use App\Entity\Predictions;




class PredictionsController extends CustomAbstractController
{
    /**
     * @Route("/{round}/predictions/insert", name="predictions")
     */
    public function insertPredictions($round, Request $request)
    {

        $roundId = $round;
        $token = $request->headers->get('token');
        $repository = $this->getDoctrine()->getRepository(AuthenticationTokens::class);
        $authManager = new AuthManager($repository);
        $userInfo = $authManager->getUserIdByToken($token);
        $userId = $userInfo['Msg']['user_id'];
        $predictionsJSON = $request->request->get("predictions");
        $entityManager = $this->getDoctrine()->getManager();
        $predictionsManager = new PredictionsManager(null, $entityManager);
        $gameName = $request->request->get('predictions');
        return $this->json($predictionsManager->insertMultiplePredictions($predictionsJSON, $roundId, $userId));
    }
}

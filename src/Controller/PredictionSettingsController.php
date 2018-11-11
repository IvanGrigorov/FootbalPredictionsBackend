<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\PredictionsSettingsManagement\PredictionsSettings\Lib\PredictionsSettingsManager;
use App\Entity\PredictionSettings;

class PredictionSettingsController extends CustomAbstractController
{
    /**
     * @Route("{roundId}/predictions/settings/insert", name="predictions_settings_insert")
     */
    public function pointSettingsInsert($roundId, Request $request)
    {
        $predictionsSettingsInfo = $request->request->get('until');
        $entityManager = $this->getDoctrine()->getManager();
        $predictionsSettingsManager = new PredictionsSettingsManager(null, $entityManager);
        return $this->json($predictionsSettingsManager->setPredictionsSettingsForRound($roundId, $predictionsSettingsInfo));
    }

    /**
     * @Route("{roundId}/predictions/settings/update", name="predictions_settings_update")
     */
    public function pointSettingsUpdate($roundId, Request $request)
    {
        $predictionsSettingsInfo = $request->request->get('until');
        $entityManager = $this->getDoctrine()->getManager();
        $predictionSettingsRepository = $this->getDoctrine()->getRepository(PredictionSettings::class);
        $predictionsSettingsManager = new PredictionsSettingsManager($predictionSettingsRepository, $entityManager);
        return $this->json($predictionsSettingsManager->updatePredictionsSettingsForRound($roundId, $predictionsSettingsInfo));
    }
}

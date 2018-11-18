<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\PointSettingsManagement\PointSettings\Lib\PointSettingsManager;
use App\Entity\PointSettings;

class PointSettingsController extends CustomAbstractController
{
    /**
     * @Route("{gameId}/point/settings/insert", name="point_settings_insert")
     */
    public function pointSettingsInsert($gameId, Request $request)
    {
        $pointSettingsInfo = $request->request->get('pointSettingsInfo');
        $entityManager = $this->getDoctrine()->getManager();
        $pointSettingsManager = new PointSettingsManager(null, $entityManager);
        return $this->json($pointSettingsManager->setPointSettingsForGame($gameId, $pointSettingsInfo));
    }

    /**
     * @Route("{gameId}/point/settings/update", name="point_settings_update")
     */
    public function pointSettingsUpdate($gameId, Request $request)
    {
        $pointSettingsInfo = $request->request->get('pointSettingsInfo');
        $entityManager = $this->getDoctrine()->getManager();
        $pointSettingsRepository = $this->getDoctrine()->getRepository(PointSettings::class);
        $pointSettingsManager = new PointSettingsManager($pointSettingsRepository, $entityManager);
        return $this->json($pointSettingsManager->updatePointSettingsForGame($gameId, $pointSettingsInfo));
    }
}

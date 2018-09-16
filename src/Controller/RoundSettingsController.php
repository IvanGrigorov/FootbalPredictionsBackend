<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\RoundSettingsManagement\RoundSettings\Lib\RoundSettingsManager;



class RoundSettingsController extends CustomAbstractController
{
    /**
     * @Route("/round/settings/insert", name="round_settings_insert")
     */
    public function insertRoundSettings(Request $request)
    {

        
        $isAdminLogged = $this->checkIfAdminIsLogged($request);

        if (isset($isAdminLogged['Error'])) {
            return $this->json($isAdminLogged);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $roundSettingsManager = new RoundSettingsManager(null, $entityManager);
        $roundSettingsUntil = $request->request->get('until');
        $roundSettingsRoundId= $request->request->get('roundId');
        return $this->json($roundSettingsManager->insertRoundSettings($roundSettingsUntil, $roundSettingsRoundId));
    }
}

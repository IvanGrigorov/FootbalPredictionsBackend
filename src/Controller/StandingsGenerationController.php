<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\AbstractController\CustomAbstractController;
use App\CoreLibs\GamesAndUsersManagement\GamesAndUsers\Lib\GamesAndUsersManager;
use App\CoreLibs\GenerationStandingsManagement\GenerationStandings\Lib\GenerationStandingsManager;
use App\CoreLibs\PredictionsManagement\Predictions\Lib\PredictionsManager;
use App\CoreLibs\RealResultsManagement\RealResults\Lib\RealResultsManager;
use App\CoreLibs\RoundStandingsManagement\RoundStandings\Lib\RoundStandingsManager;
use App\CoreLibs\GeneralStandingsManagement\GeneralStandings\Lib\GeneralStandingsManager;
use App\CoreLibs\RoundGenerationStatusManagement\RoundGenerationStatus\Lib\RoundGenerationStatusManager;
use App\CoreLibs\PointSettingsManagement\PointSettings\Lib\PointSettingsManager;
use App\Entity\PointSettings;
use App\Entity\RoundGenerationStatus;
use App\Entity\Standings;
use App\Entity\RoundStandings;
use App\Entity\GamesAndUsers;
use App\Entity\Predictions;
use App\Entity\RealResults;



class StandingsGenerationController extends CustomAbstractController
{
    /**
     * @Route("/{game}/{round}/standings/generation", name="standings_generation")
     */
    public function generateStandings($game, $round)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $gamesAndUsersrepository = $this->getDoctrine()->getRepository(GamesAndUsers::class);
        $gameAndUsersManager = new GamesAndUsersManager($gamesAndUsersrepository);
        $predictionsRepository = $this->getDoctrine()->getRepository(Predictions::class);
        $predictionsManager = new PredictionsManager($predictionsRepository);
        $realResultsRepository = $this->getDoctrine()->getRepository(RealResults::class);
        $realResultsManager = new RealResultsManager($realResultsRepository);
        $roundStandingsRepository = $this->getDoctrine()->getRepository(RoundStandings::class);
        $roundStandingsManager = new RoundStandingsManager($realResultsRepository, $entityManager);
        $generalStandingsRepository = $this->getDoctrine()->getRepository(Standings::class);
        $generalStandingsManager = new GeneralStandingsManager($generalStandingsRepository, $entityManager);
        $roundGenerationStatusRepository = $this->getDoctrine()->getRepository(RoundGenerationStatus::class);
        $roundGenerationStatusManager = new RoundGenerationStatusManager($roundGenerationStatusRepository, $entityManager);
        $pointSettingsRepository = $this->getDoctrine()->getRepository(PointSettings::class);
        $pointSettingsManager = new PointSettingsManager($pointSettingsRepository, $entityManager);
        $generationStandingsManager = new GenerationStandingsManager(
            $gameAndUsersManager,
            $predictionsManager, 
            $realResultsManager, 
            $roundStandingsManager, 
            $generalStandingsManager,
            $roundGenerationStatusManager,
            $pointSettingsManager,
            null, 
            $entityManager);
        return $this->json($generationStandingsManager->generateStandings($game, $round));
 
    }
}

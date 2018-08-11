<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Controller\AbstractController\CustomAbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends CustomAbstractController {

    /**
     * Matches /home exactly
     *
     * @Route("/", name="home")
     */
    public function home()
    {
        return new Response(
            '<html><body>Lucky number: 1 </body></html>'
        );
    }
}
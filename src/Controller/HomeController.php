<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

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
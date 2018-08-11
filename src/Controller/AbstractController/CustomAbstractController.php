<?php 

namespace  App\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\CoreLibs\AuthManagement\Auth\Lib\AuthManager;
use App\Entity\Users;




abstract class CustomAbstractController extends AbstractController {

    public function checkForLoggedUser($request) {
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $authManager = new AuthManager($repository);

        if (!empty($request->headers->get('token'))) {
            $checkAuth = $authManager->checkAuthByToken($request->headers->get('token'));
            if (isset($checkAuth['Error'])) {
                return $checkAuth;
            }
            else {
                return 
                    array(
                        'Success' => 'IsAuthenticated',
                        'Msg' => 'The user is authenticated'
                    );
            }

        }
        else {
            return
                array(
                    'Error' => 'NotAuthenticated',
                    'Msg' => 'Cannot access it without log in'
                );
        }
    }

    public function checkIfAdminIsLogged() {

    }
}


<?php

namespace App\Tests\AuthMngmntTests;
use App\CoreLibs\AuthManagement\Auth\Lib\AuthManager;
use App\Entity\Users;
use App\Entity\AuthenticationTokens;



//use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;



class AuthManagerTest extends KernelTestCase {

    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

    }

    public function testLogOutWithWrongToken() {
        // Arrange 
        $repository = $this->entityManager
            ->getRepository(AuthenticationTokens::class);
        $authManager = new AuthManager($repository, $this->entityManager);
        $token = 'fakeToken';

        // Act 
        $tryToLogOut = $authManager->logOut($token);

        //Assert
        $this->assertTrue(!empty($tryToLogOut));
    }

}
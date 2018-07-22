<?php

namespace App\Repository;

use App\Entity\AuthenticationTokens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AuthenticationTokens|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthenticationTokens|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthenticationTokens[]    findAll()
 * @method AuthenticationTokens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthenticationTokensRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AuthenticationTokens::class);
    }

//    /**
//     * @return AuthenticationTokens[] Returns an array of AuthenticationTokens objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneByToken($value): ?AuthenticationTokens
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.token = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}

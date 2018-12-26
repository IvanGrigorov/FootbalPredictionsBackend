<?php

namespace App\Repository;

use App\Entity\GamesAndUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\ResultSetMapping;


/**
 * @method GamesAndUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method GamesAndUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method GamesAndUsers[]    findAll()
 * @method GamesAndUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamesAndUsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GamesAndUsers::class);
    }

//    /**
//     * @return GamesAndUsers[] Returns an array of GamesAndUsers objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GamesAndUsers
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findAllUsersForGame($gameId)
    {
        return $this->createQueryBuilder('gu')
            ->select('gu.UserId')
            ->andWhere('gu.GameId = :val')
            ->setParameter('val', $gameId)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getUserIFExists($gameId, $userId) {
        return $this->createQueryBuilder('g')
        ->andWhere('g.GameId = :gameId')
        ->andWhere('g.UserId = :userId')
        ->setParameter('gameId', $gameId)
        ->setParameter('userId', $userId)
        ->getQuery()
        ->getOneOrNullResult()
    ;
    }
}

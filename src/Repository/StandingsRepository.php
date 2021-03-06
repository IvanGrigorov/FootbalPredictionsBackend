<?php

namespace App\Repository;

use App\Entity\Standings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Standings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Standings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Standings[]    findAll()
 * @method Standings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StandingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Standings::class);
    }

//    /**
//     * @return Standings[] Returns an array of Standings objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Standings
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getGeneralStandingsForUser($gameId, $userId) {
        return $this->createQueryBuilder('s')
            ->andWhere('s.GameId = :gameId')
            ->andWhere('s.UserId = :userId')
            ->setParameter('gameId', $gameId)
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getGeneralStandingsForGame($gameId) {
        return $this->createQueryBuilder('s')
            ->select('s.Points, u.name')
            ->from('App\Entity\Users', 'u')
            ->andWhere('s.UserId = u.id')
            ->andWhere('s.GameId = :val')
            ->setParameter(':val', $gameId)
            ->getQuery()
            ->getResult()
            ;
    }
}

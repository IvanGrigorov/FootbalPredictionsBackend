<?php

namespace App\Repository;

use App\Entity\Rounds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rounds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rounds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rounds[]    findAll()
 * @method Rounds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rounds::class);
    }

//    /**
//     * @return Rounds[] Returns an array of Rounds objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rounds
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllRoundsForGameId($gameId) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.GamesId = :val')
            ->setParameter('val', $gameId)
            ->getQuery()
            ->getResult();
    }
}

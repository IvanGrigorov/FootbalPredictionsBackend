<?php

namespace App\Repository;

use App\Entity\RoundStandings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoundStandings|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoundStandings|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoundStandings[]    findAll()
 * @method RoundStandings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundStandingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoundStandings::class);
    }

//    /**
//     * @return RoundStandings[] Returns an array of RoundStandings objects
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
    public function findOneBySomeField($value): ?RoundStandings
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

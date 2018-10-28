<?php

namespace App\Repository;

use App\Entity\RealResults;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RealResults|null find($id, $lockMode = null, $lockVersion = null)
 * @method RealResults|null findOneBy(array $criteria, array $orderBy = null)
 * @method RealResults[]    findAll()
 * @method RealResults[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RealResultsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RealResults::class);
    }

//    /**
//     * @return RealResults[] Returns an array of RealResults objects
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
    public function findOneBySomeField($value): ?RealResults
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getRealResultsForRoundId($roundId) {
        return $this->createQueryBuilder('rr')
            ->select('rr.RoundTeamsId', 'rr.Host', 'rr.Guest', 'rr.RoundId')
            ->andWhere('rr.RoundId = :val')
            ->setParameter('val', $roundId)
            ->getQuery()
            ->getResult()
        ;
    }
}

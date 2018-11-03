<?php

namespace App\Repository;

use App\Entity\RoundGenerationStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoundGenerationStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoundGenerationStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoundGenerationStatus[]    findAll()
 * @method RoundGenerationStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundGenerationStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoundGenerationStatus::class);
    }

//    /**
//     * @return RoundGenerationStatus[] Returns an array of RoundGenerationStatus objects
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
    public function findOneBySomeField($value): ?RoundGenerationStatus
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findStatusByRoundId($roundId) {
        return $this->createQueryBuilder('rs')
        ->andWhere('rs.RoundId = :val')
        ->setParameter('val', $roundId)
        ->getQuery()
        ->getOneOrNullResult()
    ;
    }
}

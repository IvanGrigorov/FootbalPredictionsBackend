<?php

namespace App\Repository;

use App\Entity\PointSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PointSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointSettings[]    findAll()
 * @method PointSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointSettingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PointSettings::class);
    }

//    /**
//     * @return PointSettings[] Returns an array of PointSettings objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PointSettings
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getPointSettingsInfo($gameId) {
        return $this->createQueryBuilder('p')
            ->andWhere('p.GameId = :val')
            ->setParameter('val', $gameId)
            ->getQuery()
            ->getOneOrNullResult()
    ;
    }
}

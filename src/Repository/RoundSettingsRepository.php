<?php

namespace App\Repository;

use App\Entity\RoundSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoundSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoundSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoundSettings[]    findAll()
 * @method RoundSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundSettingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoundSettings::class);
    }

//    /**
//     * @return RoundSettings[] Returns an array of RoundSettings objects
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
    public function findOneBySomeField($value): ?RoundSettings
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

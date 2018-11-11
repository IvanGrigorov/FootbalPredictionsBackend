<?php

namespace App\Repository;

use App\Entity\PredictionSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PredictionSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method PredictionSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method PredictionSettings[]    findAll()
 * @method PredictionSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PredictionSettingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PredictionSettings::class);
    }

//    /**
//     * @return PredictionSettings[] Returns an array of PredictionSettings objects
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
    public function findOneBySomeField($value): ?PredictionSettings
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getPredictionsSettingsInfo($roundId) {
        return $this->createQueryBuilder('p')
            //->select('p.Until')
            ->andWhere('p.RoundId = :val')
            ->setParameter('val', $roundId)
            ->getQuery()
            ->getOneOrNullResult()
    ;
    }
}

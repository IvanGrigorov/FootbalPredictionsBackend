<?php

namespace App\Repository;

use App\Entity\Predictions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Predictions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Predictions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Predictions[]    findAll()
 * @method Predictions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PredictionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Predictions::class);
    }

//    /**
//     * @return Predictions[] Returns an array of Predictions objects
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

    
    public function findPredictionsByRoundId($roundId): ?Predictions
    {
        return $this->createQueryBuilder('p')
            ->select('r, u.name', 'rt.Host', 'rt.Guest')
            ->from('App\Entity\Users', 'u')
            ->from('App\Entity\RoundTeams', 'rt') 
            ->andWhere('p.RoindId = :val')
            ->andWhere('rt.id = p.')
            ->andWhere('u.id = p.RoundTeamsId')
            ->setParameter('val', $roundId)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findPredictionsForRoundByUserId($roundId, $userId) {
        return $this->createQueryBuilder('p')
            ->select('p.Host', 'p.Guest', 'p.RoundTeamsId', 'u.name', 'rt.Host as HostName', 'rt.Guest as GuestName')
            ->from('App\Entity\Users', 'u')
            ->from('App\Entity\RoundTeams', 'rt') 
            ->andWhere('p.RoindId = :roundId')
            ->andWhere('p.UserId = :userId')
            ->andWhere('rt.id = p.RoundTeamsId')
            ->andWhere('u.id = p.UserId')
            ->setParameter('roundId', $roundId)
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findPredictionsForRoundById($predictionsId) {
        return $this->createQueryBuilder('p')
        ->andWhere('p.id = :val')
        ->setParameter('val', $predictionsId)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
    
}

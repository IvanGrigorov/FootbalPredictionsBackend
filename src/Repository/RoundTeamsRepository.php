<?php

namespace App\Repository;

use App\Entity\RoundTeams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoundTeams|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoundTeams|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoundTeams[]    findAll()
 * @method RoundTeams[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundTeamsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoundTeams::class);
    }

//    /**
//     * @return RoundTeams[] Returns an array of RoundTeams objects
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
    public function findOneBySomeField($value): ?RoundTeams
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findAllTeamsForRound($roundId) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.RoundId = :val')
            ->setParameter('val', $roundId)
            ->getQuery()
            ->getResult();
    }

    public function findTeamsById($roundTeamsId) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :val')
            ->setParameter('val', $roundTeamsId)
            ->getQuery()
            ->getOneOrNullResult();    
        }
}

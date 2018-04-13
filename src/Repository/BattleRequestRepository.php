<?php

namespace App\Repository;

use App\Entity\BattleRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BattleRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method BattleRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method BattleRequest[]    findAll()
 * @method BattleRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BattleRequestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BattleRequest::class);
    }

//    /**
//     * @return BattleRequest[] Returns an array of BattleRequest objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BattleRequest
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

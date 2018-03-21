<?php

namespace App\Repository;

use App\Entity\BattleRequests;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BattleRequests|null find($id, $lockMode = null, $lockVersion = null)
 * @method BattleRequests|null findOneBy(array $criteria, array $orderBy = null)
 * @method BattleRequests[]    findAll()
 * @method BattleRequests[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BattleRequestsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BattleRequests::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.something = :value')->setParameter('value', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}

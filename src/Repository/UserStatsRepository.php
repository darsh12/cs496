<?php

namespace App\Repository;

use App\Entity\UserStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStats[]    findAll()
 * @method UserStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStatsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserStats::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}

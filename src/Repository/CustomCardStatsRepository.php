<?php

namespace App\Repository;

use App\Entity\CustomCardStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomCardStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomCardStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomCardStats[]    findAll()
 * @method CustomCardStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomCardStatsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomCardStats::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}

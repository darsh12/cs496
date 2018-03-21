<?php

namespace App\Repository;

use App\Entity\CharCardStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharCardStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharCardStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharCardStats[]    findAll()
 * @method CharCardStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharCardStatsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharCardStats::class);
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

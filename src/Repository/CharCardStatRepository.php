<?php

namespace App\Repository;

use App\Entity\CharCardStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharCardStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharCardStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharCardStat[]    findAll()
 * @method CharCardStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharCardStatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharCardStat::class);
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

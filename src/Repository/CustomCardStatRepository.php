<?php

namespace App\Repository;

use App\Entity\CustomCardStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomCardStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomCardStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomCardStat[]    findAll()
 * @method CustomCardStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomCardStatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomCardStat::class);
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

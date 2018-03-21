<?php

namespace App\Repository;

use App\Entity\Rewards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rewards|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rewards|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rewards[]    findAll()
 * @method Rewards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RewardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rewards::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('r')
            ->where('r.something = :value')->setParameter('value', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}

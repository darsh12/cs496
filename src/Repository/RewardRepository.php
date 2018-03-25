<?php

namespace App\Repository;

use App\Entity\Reward;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reward|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reward|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reward[]    findAll()
 * @method Reward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RewardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reward::class);
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

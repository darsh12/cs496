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

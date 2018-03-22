<?php

namespace App\Repository;

use App\Entity\Battle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Battle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Battle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Battle[]    findAll()
 * @method Battle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BattleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Battle::class);
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

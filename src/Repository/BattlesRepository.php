<?php

namespace App\Repository;

use App\Entity\Battles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Battles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Battles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Battles[]    findAll()
 * @method Battles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BattlesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Battles::class);
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

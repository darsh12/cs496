<?php

namespace App\Repository;

use App\Entity\UtilDeck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UtilDeck|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilDeck|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilDeck[]    findAll()
 * @method UtilDeck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilDeckRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UtilDeck::class);
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

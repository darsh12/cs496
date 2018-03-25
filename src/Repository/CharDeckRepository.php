<?php

namespace App\Repository;

use App\Entity\CharDeck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharDeck|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharDeck|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharDeck[]    findAll()
 * @method CharDeck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharDeckRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharDeck::class);
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

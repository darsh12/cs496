<?php

namespace App\Repository;

use App\Entity\CharDecks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharDecks|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharDecks|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharDecks[]    findAll()
 * @method CharDecks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharDecksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharDecks::class);
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

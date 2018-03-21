<?php

namespace App\Repository;

use App\Entity\CharCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharCards[]    findAll()
 * @method CharCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharCardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharCards::class);
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

<?php

namespace App\Repository;

use App\Entity\CustomCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomCards[]    findAll()
 * @method CustomCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomCardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomCards::class);
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

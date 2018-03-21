<?php

namespace App\Repository;

use App\Entity\UtilCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UtilCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilCards[]    findAll()
 * @method UtilCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilCardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UtilCards::class);
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

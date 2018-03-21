<?php

namespace App\Repository;

use App\Entity\UserUtilCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserUtilCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserUtilCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserUtilCards[]    findAll()
 * @method UserUtilCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserUtilCardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserUtilCards::class);
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

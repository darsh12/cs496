<?php

namespace App\Repository;

use App\Entity\UserCharCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCharCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCharCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCharCards[]    findAll()
 * @method UserCharCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCharCardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCharCards::class);
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

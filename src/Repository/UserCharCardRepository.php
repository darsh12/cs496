<?php

namespace App\Repository;

use App\Entity\UserCharCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCharCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCharCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCharCard[]    findAll()
 * @method UserCharCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCharCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCharCard::class);
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

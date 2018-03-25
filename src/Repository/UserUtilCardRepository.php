<?php

namespace App\Repository;

use App\Entity\UserUtilCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserUtilCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserUtilCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserUtilCard[]    findAll()
 * @method UserUtilCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserUtilCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserUtilCard::class);
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

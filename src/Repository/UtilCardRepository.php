<?php

namespace App\Repository;

use App\Entity\UtilCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UtilCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilCard[]    findAll()
 * @method UtilCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UtilCard::class);
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

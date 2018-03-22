<?php

namespace App\Repository;

use App\Entity\CustomCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomCard[]    findAll()
 * @method CustomCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomCard::class);
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

<?php

namespace App\Repository;

use App\Entity\Avatars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Avatars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avatars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avatars[]    findAll()
 * @method Avatars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvatarsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Avatars::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.something = :value')->setParameter('value', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}

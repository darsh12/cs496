<?php

namespace App\Repository;

use App\Entity\DefUtilEffects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DefUtilEffects|null find($id, $lockMode = null, $lockVersion = null)
 * @method DefUtilEffects|null findOneBy(array $criteria, array $orderBy = null)
 * @method DefUtilEffects[]    findAll()
 * @method DefUtilEffects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefUtilEffectsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DefUtilEffects::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('d')
            ->where('d.something = :value')->setParameter('value', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}

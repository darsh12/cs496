<?php

namespace App\Repository;

use App\Entity\AtkUtilEffects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AtkUtilEffects|null find($id, $lockMode = null, $lockVersion = null)
 * @method AtkUtilEffects|null findOneBy(array $criteria, array $orderBy = null)
 * @method AtkUtilEffects[]    findAll()
 * @method AtkUtilEffects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtkUtilEffectsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AtkUtilEffects::class);
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

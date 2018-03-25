<?php

namespace App\Repository;

use App\Entity\AtkUtilEffect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AtkUtilEffect|null find($id, $lockMode = null, $lockVersion = null)
 * @method AtkUtilEffect|null findOneBy(array $criteria, array $orderBy = null)
 * @method AtkUtilEffect[]    findAll()
 * @method AtkUtilEffect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtkUtilEffectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AtkUtilEffect::class);
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

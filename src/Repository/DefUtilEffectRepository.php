<?php

namespace App\Repository;

use App\Entity\DefUtilEffect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DefUtilEffect|null find($id, $lockMode = null, $lockVersion = null)
 * @method DefUtilEffect|null findOneBy(array $criteria, array $orderBy = null)
 * @method DefUtilEffect[]    findAll()
 * @method DefUtilEffect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefUtilEffectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DefUtilEffect::class);
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

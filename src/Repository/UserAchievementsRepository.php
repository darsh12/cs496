<?php

namespace App\Repository;

use App\Entity\UserAchievements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserAchievements|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAchievements|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAchievements[]    findAll()
 * @method UserAchievements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAchievementsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserAchievements::class);
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

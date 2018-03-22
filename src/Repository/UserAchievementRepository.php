<?php

namespace App\Repository;

use App\Entity\UserAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAchievement[]    findAll()
 * @method UserAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAchievementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserAchievement::class);
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

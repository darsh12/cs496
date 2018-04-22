<?php

namespace App\Repository;

use App\Entity\UserUtilCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserUtilCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserUtilCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserUtilCards[]    findAll()
 * @method UserUtilCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserUtilCardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserUtilCards::class);
    }


    /**
     * Exclusively used on forms only
     * @param $user
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getUserCards($user) {
        return $this->createQueryBuilder('u')
            ->andWhere('u.user = :user')
            ->setParameter('user', $user);


    }

    public function distinctUtilCards($user) {
        return $this->createQueryBuilder('u')
            ->andWhere('u.user = :user')
            ->setParameter('user', $user)
            ->select('DISTINCT COUNT(u.util_card) as util_card')
            ->getQuery()
            ->getSingleScalarResult();

    }

//    /**
//     * @return UserUtilCards[] Returns an array of UserUtilCards objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserUtilCards
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

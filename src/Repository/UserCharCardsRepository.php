<?php

namespace App\Repository;

use App\Entity\UserCharCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCharCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCharCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCharCards[]    findAll()
 * @method UserCharCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCharCardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCharCards::class);
    }

    public function distinctCharCards($user) {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user')
            ->setParameter('user', $user)
            ->select('DISTINCT COUNT(c.char_card) as char_card')
            ->getQuery()
            ->getSingleScalarResult();
    }
//    /**
//     * @return UserCharCards[] Returns an array of UserCharCards objects
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
    public function findOneBySomeField($value): ?UserCharCards
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

<?php

namespace App\Repository;

use App\Entity\UserCharDecks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCharDecks|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCharDecks|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCharDecks[]    findAll()
 * @method UserCharDecks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCharDecksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCharDecks::class);
    }

//    /**
//     * @return UserCharDecks[] Returns an array of UserCharDecks objects
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
    public function findOneBySomeField($value): ?UserCharDecks
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

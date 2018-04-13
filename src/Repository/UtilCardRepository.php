<?php

namespace App\Repository;

use App\Entity\UtilCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UtilCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilCard[]    findAll()
 * @method UtilCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UtilCard::class);
    }

//    /**
//     * @return UtilCard[] Returns an array of UtilCard objects
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
    public function findOneBySomeField($value): ?UtilCard
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

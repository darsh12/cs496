<?php

namespace App\Repository;

use App\Entity\CustomCardVote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomCardVote|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomCardVote|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomCardVote[]    findAll()
 * @method CustomCardVote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomCardVoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomCardVote::class);
    }

//    /**
//     * @return CustomCardVote[] Returns an array of CustomCardVote objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomCardVote
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

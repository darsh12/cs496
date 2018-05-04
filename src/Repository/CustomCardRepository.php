<?php

namespace App\Repository;

use App\Entity\CustomCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomCard[]    findAll()
 * @method CustomCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomCard::class);
    }

//    /**
//     * @return CustomCard[] Returns an array of CustomCard objects
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
    public function findOneBySomeField($value): ?CustomCard
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllCardsSortByDateTimeAsc() {
        return $this->createQueryBuilder('cc')
            ->addOrderBy('cc.dateCreated', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneCardByLastEntry($cardDateTime) {
        return $this->createQueryBuilder('cc')
            ->addOrderBy('cc.dateCreated', 'DESC')
            ->where('cc.dateCreated = :cardDateTime')
            ->setParameter('cardDateTime', $cardDateTime)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneCardByUser($userId) {
        return $this->createQueryBuilder('cc')
            ->where('cc.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllCardsSortByVotePercDesc() {
        return $this->createQueryBuilder('cc')
            ->addOrderBy('cc.vote_perc', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

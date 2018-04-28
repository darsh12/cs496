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
            ->select('cc.id', 'cc.char_name', 'cc.char_class', 'cc.char_type', 'cc.char_tier', 'cc.rating',
                'cc.hit_points', 'cc.attack', 'cc.defense', 'cc.luck', 'cc.agility', 'cc.speed',
                'cc.dateCreated', 'cc.dateAccepted', 'cc.image_file')
            ->addOrderBy('cc.dateCreated', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneCardByLastEntry($cardDateTime) {
        return $this->createQueryBuilder('cc')
            ->select('cc.id', 'cc.char_name', 'cc.char_class', 'cc.char_type', 'cc.char_tier', 'cc.rating',
                'cc.hit_points', 'cc.attack', 'cc.defense', 'cc.luck', 'cc.agility', 'cc.speed',
                'cc.dateCreated', 'cc.image_file')
            ->addOrderBy('cc.dateCreated', 'DESC')
            ->where('cc.dateCreated = :cardDateTime')
            ->setParameter('cardDateTime', $cardDateTime)
            ->getQuery()
            ->getSingleResult();
    }
}

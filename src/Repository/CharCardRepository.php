<?php

namespace App\Repository;

use App\Entity\CharCard;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharCard[]    findAll()
 * @method CharCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharCard::class);
    }


    /**
     * @return CharCard[] Returns an array of CharCard objects
     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    */

    /*
    public function findOneBySomeField($value): ?CharCard
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
    }
    */
    public function findAllCardsSortByRatingDesc() {
        return $this->createQueryBuilder('cc')
            ->innerJoin('cc.avatar', 'av')
            ->select('cc.id','cc.char_name', 'cc.char_class', 'cc.char_type', 'cc.char_tier', 'cc.rating',
            'cc.hit_points', 'cc.attack', 'cc.defense', 'cc.luck', 'cc.agility', 'cc.speed', 'av.image_path')
            ->addOrderBy('cc.rating', 'DESC')
            ->addOrderBy('cc.char_name')
            ->getQuery()
            ->getResult();
    }
}

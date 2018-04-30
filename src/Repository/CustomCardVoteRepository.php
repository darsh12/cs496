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

    public function getTotalVoteCount($customCardId) {
        return $this->createQueryBuilder('ccv')
            ->select('count(ccv.customCard)')
            ->where('ccv.customCard = :customCardId')
            ->setParameter('customCardId', $customCardId)
            ->getQuery()
            ->getSingleResult();
    }

    public function getUpVoteCount($customCardId) {
        return $this->createQueryBuilder('ccv')
            ->select('count(ccv.customCard)')
            ->where('ccv.customCard = :customCardId')
            ->andWhere('ccv.vote = :up')
            ->setParameter('customCardId', $customCardId)
            ->setParameter('up', 'Up')
            ->getQuery()
            ->getSingleResult();
    }

    public function getDownVoteCount($customCardId) {
        return $this->createQueryBuilder('ccv')
            ->select('count(ccv.customCard)')
            ->where('ccv.customCard = :customCardId')
            ->andWhere('ccv.vote = :down')
            ->setParameter('customCardId', $customCardId)
            ->setParameter('down', 'Down')
            ->getQuery()
            ->getSingleResult();
    }
}

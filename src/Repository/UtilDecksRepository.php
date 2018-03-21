<?php

namespace App\Repository;

use App\Entity\UtilDecks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UtilDecks|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilDecks|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilDecks[]    findAll()
 * @method UtilDecks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilDecksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UtilDecks::class);
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

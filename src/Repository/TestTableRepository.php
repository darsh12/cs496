<?php

namespace App\Repository;

use App\Entity\TestTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TestTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestTable[]    findAll()
 * @method TestTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestTableRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TestTable::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('t')
            ->where('t.something = :value')->setParameter('value', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}

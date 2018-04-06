<?php

namespace App\Repository;

use App\Entity\CharCard;
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

    public function findAllCards() {
        return $this->createQueryBuilder('cc')
            ->innerJoin('cc.avatar_id', 'av')
            ->select('cc.id','cc.char_name', 'cc.char_class', 'cc.char_type', 'cc.char_tier', 'cc.hit_points',
            'cc.attack', 'cc.defense', 'cc.luck', 'cc.agility', 'cc.speed', 'av.image_path')
            ->orderBy('cc.char_type')
            ->orderBy('cc.char_name')
            ->getQuery()
            ->getResult();
    }
}

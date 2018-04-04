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
            ->innerJoin('cc.char_stat_id', 'st')
            ->select('cc.char_name', 'cc.char_class', 'cc.char_type', 'cc.char_tier', 'av.image_path', 'st.hit_points',
            'st.attack', 'st.defense', 'st.luck', 'st.agility', 'st.speed')
            ->orderBy('cc.char_type')
            ->orderBy('cc.char_name')
            ->getQuery()
            ->getResult();
    }
}

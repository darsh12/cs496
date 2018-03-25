<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CharCardStatRepository")
 */
class CharCardStat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharCard", mappedBy="char_stat_id")
     */
    protected $char_card_stats;

    public function __construct()
    {
        $this->char_card_stats = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer")
     */
    protected $hit_points;

    /**
     * @ORM\Column(type="integer")
     */
    protected $attack;

    /**
     * @ORM\Column(type="integer")
     */
    protected $defense;

    /**
     * @ORM\Column(type="integer")
     */
    protected $agility;

    /**
     * @ORM\Column(type="integer")
     */
    protected $luck;

    /**
     * @ORM\Column(type="integer")
     */
    protected $speed;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getHitPoints()
    {
        return $this->hit_points;
    }

    /**
     * @param mixed $hit_points
     */
    public function setHitPoints($hit_points): void
    {
        $this->hit_points = $hit_points;
    }

    /**
     * @return mixed
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * @param mixed $attack
     */
    public function setAttack($attack): void
    {
        $this->attack = $attack;
    }

    /**
     * @return mixed
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @param mixed $defense
     */
    public function setDefense($defense): void
    {
        $this->defense = $defense;
    }

    /**
     * @return mixed
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @param mixed $agility
     */
    public function setAgility($agility): void
    {
        $this->agility = $agility;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     */
    public function setLuck($luck): void
    {
        $this->luck = $luck;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed): void
    {
        $this->speed = $speed;
    }
}

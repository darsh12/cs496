<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomCardRepository")
 */
class CustomCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="custom_card_users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $votes;

    /**
     * @ORM\Column(type="string")
     */
    protected $char_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $char_type;

    /**
     * @ORM\Column(type="string")
     */
    protected $char_class;

    /**
     * @ORM\Column(type="string")
     */
    protected $char_tier;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rating;

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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId(User $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
    }

    /**
     * @return mixed
     */
    public function getCharName()
    {
        return $this->char_name;
    }

    /**
     * @param mixed $char_name
     */
    public function setCharName($char_name): void
    {
        $this->char_name = $char_name;
    }

    /**
     * @return mixed
     */
    public function getCharType()
    {
        return $this->char_type;
    }

    /**
     * @param mixed $char_type
     */
    public function setCharType($char_type): void
    {
        $this->char_type = $char_type;
    }

    /**
     * @return mixed
     */
    public function getCharClass()
    {
        return $this->char_class;
    }

    /**
     * @param mixed $char_class
     */
    public function setCharClass($char_class): void
    {
        $this->char_class = $char_class;
    }

    /**
     * @return mixed
     */
    public function getCharTier()
    {
        return $this->char_tier;
    }

    /**
     * @param mixed $char_tier
     */
    public function setCharTier($char_tier): void
    {
        $this->char_tier = $char_tier;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
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

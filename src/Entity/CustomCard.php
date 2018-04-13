<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomCardRepository")
 */
class CustomCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="customCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $votes=0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $char_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $char_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $char_class;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $char_tier;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\Column(type="integer")
     */
    private $hit_points;

    /**
     * @ORM\Column(type="integer")
     */
    private $attack;

    /**
     * @ORM\Column(type="integer")
     */
    private $defense;

    /**
     * @ORM\Column(type="integer")
     */
    private $agility;

    /**
     * @ORM\Column(type="integer")
     */
    private $luck;

    /**
     * @ORM\Column(type="integer")
     */
    private $speed;


    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVotes(): ?int
    {
        return $this->votes;
    }

    public function setVotes(int $votes): self
    {
        $this->votes = $votes;

        return $this;
    }

    public function getCharName(): ?string
    {
        return $this->char_name;
    }

    public function setCharName(string $char_name): self
    {
        $this->char_name = $char_name;

        return $this;
    }

    public function getCharType(): ?string
    {
        return $this->char_type;
    }

    public function setCharType(string $char_type): self
    {
        $this->char_type = $char_type;

        return $this;
    }

    public function getCharClass(): ?string
    {
        return $this->char_class;
    }

    public function setCharClass(string $char_class): self
    {
        $this->char_class = $char_class;

        return $this;
    }

    public function getCharTier(): ?string
    {
        return $this->char_tier;
    }

    public function setCharTier(string $char_tier): self
    {
        $this->char_tier = $char_tier;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getHitPoints(): ?int
    {
        return $this->hit_points;
    }

    public function setHitPoints(int $hit_points): self
    {
        $this->hit_points = $hit_points;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getAgility(): ?int
    {
        return $this->agility;
    }

    public function setAgility(int $agility): self
    {
        $this->agility = $agility;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(int $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }


}

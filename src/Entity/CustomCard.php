<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="App\Entity\CustomCardVote", mappedBy="customCard", orphanRemoval=true)
     */
    private $customCards;

    public function __construct()
    {
        parent::__construct();
        $this->customCards = new ArrayCollection();
    }

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
     * @Assert\NotBlank()
     */
    private $char_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"Action", "Comedy", "Drama"})
     */
    private $char_type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices={"DPS", "Tank"})
     */
    private $char_class;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices={"World Star", "Professional", "Amateur"})
     */
    private $char_tier;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=50, max=99)
     */
    private $rating;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=50, max=99)
     */
    private $hit_points;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=50, max=99)
     */
    private $attack;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=50, max=99)
     */
    private $defense;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=50, max=99)
     */
    private $agility;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=50, max=99)
     */
    private $luck;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=1, max=9)
     */
    private $speed;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateAccepted;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\File(
     *     maxSize = "1024M",
     *     maxSizeMessage="File must be less than 1Gb in size",
     *     mimeTypes={ "image/*" },
     *     mimeTypesMessage="File must be an image")
     */
    private $image_file;

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

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return mixed
     */
    public function getDateAccepted()
    {
        return $this->dateAccepted;
    }

    /**
     * @param mixed $dateAccepted
     */
    public function setDateAccepted($dateAccepted): void
    {
        $this->dateAccepted = $dateAccepted;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->image_file;
    }

    /**
     * @param mixed $image_file
     */
    public function setImageFile($image_file): void
    {
        $this->image_file = $image_file;
    }
}

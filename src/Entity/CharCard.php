<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharCardRepository")
 */
class CharCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $char_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices={"Action", "Comedy", "Drama"}, message="Choose a valid type: Comedy, Action, or Drama")
     */
    private $char_type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices={"DPS", "Tank"}, message="Choose a valid class: DPS or Tank")
     */
    private $char_class;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices={"World Star", "Professional", "Amateur"}, message="Choose a valid tier: World Star, Professional, or Amateur")
     */
    private $char_tier;

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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avatar", inversedBy="charCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $avatar;


    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharCards", mappedBy="char_card", orphanRemoval=true)
     */
    private $userCharCards;

    /**
     * @ORM\Column(type="integer")
     */
    private $price=0;

    public function __construct()
    {
        $this->userCharCards = new ArrayCollection();
    }




    public function getId()
    {
        return $this->id;
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

    public function getAvatar(): ?Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(?Avatar $avatar): self
    {
        $this->avatar = $avatar;

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

    /**
     * @return Collection|UserCharCards[]
     */
    public function getUserCharCards(): Collection
    {
        return $this->userCharCards;
    }

    public function addUserCard(UserCharCards $userCharCard): self
    {
        if (!$this->userCharCards->contains($userCharCard)) {
            $this->userCharCards[] = $userCharCard;
            $userCharCard->setCharCard($this);
        }

        return $this;
    }

    public function removeUserCard(UserCharCards $userCharCard): self
    {
        if ($this->userCharCards->contains($userCharCard)) {
            $this->userCharCards->removeElement($userCharCard);
            // set the owning side to null (unless already changed)
            if ($userCharCard->getCharCard() === $this) {
                $userCharCard->setCharCard(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }


}

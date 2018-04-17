<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilCardRepository")
 */
class UtilCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_swap;

    /**
     * @ORM\Column(type="integer")
     */
    private $effect_util;

    /**
     * @ORM\Column(type="integer")
     */
    private $effect_char;

    /**
     * @ORM\Column(type="integer")
     */
    private $effect_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $effect_order;

    /**
     * @ORM\Column(type="integer")
     */
    private $effect_class;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $util_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $util_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $util_tier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avatar", inversedBy="utilCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilCards", mappedBy="util_card", orphanRemoval=true)
     */
    private $userUtilCards;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $attribute_modifier;

    /**
     * @ORM\Column(type="integer")
     */
    private $price=0;

    public function __construct()
    {
        $this->userUtilCards = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getCardSwap(): ?int
    {
        return $this->card_swap;
    }

    public function setCardSwap(int $card_swap): self
    {
        $this->card_swap = $card_swap;

        return $this;
    }

    public function getEffectUtil(): ?int
    {
        return $this->effect_util;
    }

    public function setEffectUtil(int $effect_util): self
    {
        $this->effect_util = $effect_util;

        return $this;
    }

    public function getEffectChar(): ?int
    {
        return $this->effect_char;
    }

    public function setEffectChar(int $effect_char): self
    {
        $this->effect_char = $effect_char;

        return $this;
    }

    public function getEffectType(): ?int
    {
        return $this->effect_type;
    }

    public function setEffectType(int $effect_type): self
    {
        $this->effect_type = $effect_type;

        return $this;
    }

    public function getEffectOrder(): ?int
    {
        return $this->effect_order;
    }

    public function setEffectOrder(int $effect_order): self
    {
        $this->effect_order = $effect_order;

        return $this;
    }

    public function getEffectClass(): ?int
    {
        return $this->effect_class;
    }

    public function setEffectClass(int $effect_class): self
    {
        $this->effect_class = $effect_class;

        return $this;
    }

    public function getUtilName(): ?string
    {
        return $this->util_name;
    }

    public function setUtilName(string $util_name): self
    {
        $this->util_name = $util_name;

        return $this;
    }

    public function getUtilType(): ?string
    {
        return $this->util_type;
    }

    public function setUtilType(string $util_type): self
    {
        $this->util_type = $util_type;

        return $this;
    }

    public function getUtilTier(): ?string
    {
        return $this->util_tier;
    }

    public function setUtilTier(string $util_tier): self
    {
        $this->util_tier = $util_tier;

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

    /**
     * @return Collection|UserUtilCards[]
     */
    public function getUserUtilCards(): Collection
    {
        return $this->userUtilCards;
    }

    public function addUserUtilCard(UserUtilCards $userUtilCard): self
    {
        if (!$this->userUtilCards->contains($userUtilCard)) {
            $this->userUtilCards[] = $userUtilCard;
            $userUtilCard->setUtilCard($this);
        }

        return $this;
    }

    public function removeUserUtilCard(UserUtilCards $userUtilCard): self
    {
        if ($this->userUtilCards->contains($userUtilCard)) {
            $this->userUtilCards->removeElement($userUtilCard);
            // set the owning side to null (unless already changed)
            if ($userUtilCard->getUtilCard() === $this) {
                $userUtilCard->setUtilCard(null);
            }
        }

        return $this;
    }

    public function getAttributeModifier(): ?string
    {
        return $this->attribute_modifier;
    }

    public function setAttributeModifier(string $attribute_modifier): self
    {
        $this->attribute_modifier = $attribute_modifier;

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

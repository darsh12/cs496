<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AtkUtilEffectsRepository")
 */
class AtkUtilEffects
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCards", inversedBy="attack_effect_id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $attribute_mod;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_swap;

    /**
     * @ORM\Column(type="integer")
     */
    private $hide_char;

    /**
     * @ORM\Column(type="integer")
     */
    private $hide_util;

    /**
     * @ORM\Column(type="integer")
     */
    private $hide_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $hide_class;

    /**
     * @ORM\Column(type="integer")
     */
    private $hide_order;

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
    public function getAttributeMod()
    {
        return $this->attribute_mod;
    }

    /**
     * @param mixed $attribute_mod
     */
    public function setAttributeMod($attribute_mod): void
    {
        $this->attribute_mod = $attribute_mod;
    }

    /**
     * @return mixed
     */
    public function getCardSwap()
    {
        return $this->card_swap;
    }

    /**
     * @param mixed $card_swap
     */
    public function setCardSwap($card_swap): void
    {
        $this->card_swap = $card_swap;
    }

    /**
     * @return mixed
     */
    public function getHideChar()
    {
        return $this->hide_char;
    }

    /**
     * @param mixed $hide_char
     */
    public function setHideChar($hide_char): void
    {
        $this->hide_char = $hide_char;
    }

    /**
     * @return mixed
     */
    public function getHideUtil()
    {
        return $this->hide_util;
    }

    /**
     * @param mixed $hide_util
     */
    public function setHideUtil($hide_util): void
    {
        $this->hide_util = $hide_util;
    }

    /**
     * @return mixed
     */
    public function getHideType()
    {
        return $this->hide_type;
    }

    /**
     * @param mixed $hide_type
     */
    public function setHideType($hide_type): void
    {
        $this->hide_type = $hide_type;
    }

    /**
     * @return mixed
     */
    public function getHideClass()
    {
        return $this->hide_class;
    }

    /**
     * @param mixed $hide_class
     */
    public function setHideClass($hide_class): void
    {
        $this->hide_class = $hide_class;
    }

    /**
     * @return mixed
     */
    public function getHideOrder()
    {
        return $this->hide_order;
    }

    /**
     * @param mixed $hide_order
     */
    public function setHideOrder($hide_order): void
    {
        $this->hide_order = $hide_order;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="DefUtilEffectRepository")
 */
class DefUtilEffect
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="UtilCard", inversedBy="defense_effect_id")
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
    private $peek_char;

    /**
     * @ORM\Column(type="integer")
     */
    private $peek_util;

    /**
     * @ORM\Column(type="integer")
     */
    private $peek_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $peek_class;

    /**
     * @ORM\Column(type="integer")
     */
    private $peek_order;

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
    public function getPeekChar()
    {
        return $this->peek_char;
    }

    /**
     * @param mixed $peek_char
     */
    public function setPeekChar($peek_char): void
    {
        $this->peek_char = $peek_char;
    }

    /**
     * @return mixed
     */
    public function getPeekUtil()
    {
        return $this->peek_util;
    }

    /**
     * @param mixed $peek_util
     */
    public function setPeekUtil($peek_util): void
    {
        $this->peek_util = $peek_util;
    }

    /**
     * @return mixed
     */
    public function getPeekType()
    {
        return $this->peek_type;
    }

    /**
     * @param mixed $peek_type
     */
    public function setPeekType($peek_type): void
    {
        $this->peek_type = $peek_type;
    }

    /**
     * @return mixed
     */
    public function getPeekClass()
    {
        return $this->peek_class;
    }

    /**
     * @param mixed $peek_class
     */
    public function setPeekClass($peek_class): void
    {
        $this->peek_class = $peek_class;
    }

    /**
     * @return mixed
     */
    public function getPeekOrder()
    {
        return $this->peek_order;
    }

    /**
     * @param mixed $peek_order
     */
    public function setPeekOrder($peek_order): void
    {
        $this->peek_order = $peek_order;
    }
}

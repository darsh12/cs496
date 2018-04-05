<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharCardRepository")
 */
class CharCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserCharCard", mappedBy="char_cards")
     */
    protected $user_char_cards;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharCard", mappedBy="char_card_id")
     */
    protected $char_cards;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="char_card1_id")
     */
    protected $charDeck_card1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="char_card2_id")
     */
    protected $charDeck_card2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="char_card3_id")
     */
    protected $charDeck_card3;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="char_card4_id")
     */
    protected $charDeck_card4;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="char_card5_id")
     */
    protected $charDeck_card5;

    public function __construct()
    {
        $this->char_cards = new ArrayCollection();
        $this->charDeck_card1 = new ArrayCollection();
        $this->charDeck_card2 = new ArrayCollection();
        $this->charDeck_card3 = new ArrayCollection();
        $this->charDeck_card4 = new ArrayCollection();
        $this->charDeck_card5 = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getCharCards()
    {
        return $this->char_cards;
    }

    /**
     * @return Collection
     */
    public function getCharDeckCard1()
    {
        return $this->charDeck_card1;
    }

    /**
     * @return Collection
     */
    public function getCharDeckCard2()
    {
        return $this->charDeck_card2;
    }

    /**
     * @return Collection
     */
    public function getCharDeckCard3()
    {
        return $this->charDeck_card3;
    }

    /**
     * @return Collection
     */
    public function getCharDeckCard4()
    {
        return $this->charDeck_card4;
    }

    /**
     * @return Collection
     */
    public function getCharDeckCard5()
    {
        return $this->charDeck_card5;
    }

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
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCardStat", inversedBy="char_card_stats")
     * @ORM\JoinColumn(name="char_stat_id", referencedColumnName="id")
     */
    protected $char_stat_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avatar", inversedBy="char_card_avatars")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     */
    protected $avatar_id;

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
    public function getCharStatId()
    {
        return $this->char_stat_id;
    }

    /**
     * @param mixed $char_stat_id
     */
    public function setCharStatId(CharCardStat $char_stat_id): void
    {
        $this->char_stat_id = $char_stat_id;
    }

    /**
     * @return mixed
     */
    public function getAvatarId()
    {
        return $this->avatar_id;
    }

    /**
     * @param mixed $avatar_id
     */
    public function setAvatarId(Avatar $avatar_id): void
    {
        $this->avatar_id = $avatar_id;
    }
}

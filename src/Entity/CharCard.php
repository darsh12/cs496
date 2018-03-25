<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CharCardRepository")
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
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="card1_id")
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="card2_id")
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="card3_id")
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="card4_id")
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="card5_id")
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharCard", mappedBy="char_card_id")
     */
    protected $char_cards;

    public function __construct()
    {
        $this->char_cards = new ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Avatar", inversedBy="avatars")
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

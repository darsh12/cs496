<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharCardsRepository")
 */
class CharCards
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\CharDecks", inversedBy="card1_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\CharDecks", inversedBy="card2_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\CharDecks", inversedBy="card3_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\CharDecks", inversedBy="card4_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\CharDecks", inversedBy="card5_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="char_card_id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string")       // question: how do you express varchar in smyfony?
     */
    private $char_name;

    /**
     * @ORM\Column(type="string")
     */
    private $char_type;

    /**
     * @ORM\Column(type="string")
     */
    private $char_class;

    /**
     * @ORM\Column(type="string")
     */
    private $char_tier;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\CharCardStats", mappedBy="id")
     */
    private $char_stat_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\Avatars", mappedBy="id")
     */
    private $avatar_id;

    /**
     * CharCards constructor.
     * @param $char_stat_id
     * @param $avatar_id
     */
    public function __construct($char_stat_id, $avatar_id)
    {
        $this->char_stat_id = new ArrayCollection();
        $this->avatar_id = new ArrayCollection();
    }

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
    public function setCharStatId($char_stat_id): void
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
    public function setAvatarId($avatar_id): void
    {
        $this->avatar_id = $avatar_id;
    }
}

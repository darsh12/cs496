<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharDeckRepository")
 */
class CharDeck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="defend_char_deck_id")
     */
    protected $defend_char_decks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attack_char_deck_id")
     */
    protected $attack_char_decks;

    public function __construct()
    {
        $this->defend_char_decks = new ArrayCollection();
        $this->attack_char_decks = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getDefendCharDecks()
    {
        return $this->defend_char_decks;
    }

    /**
     * @return Collection
     */
    public function getAttackCharDecks()
    {
        return $this->attack_char_decks;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="char_deck_users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="charDeck_card1")
     * @ORM\JoinColumn(name="char_card1_id", referencedColumnName="id")
     */
    protected $char_card1_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="charDeck_card2")
     * @ORM\JoinColumn(name="char_card2_id", referencedColumnName="id")
     */
    protected $char_card2_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="charDeck_card3")
     * @ORM\JoinColumn(name="char_card3_id", referencedColumnName="id")
     */
    protected $char_card3_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="charDeck_card4")
     * @ORM\JoinColumn(name="char_card4_id", referencedColumnName="id")
     */
    protected $char_card4_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="charDeck_card5")
     * @ORM\JoinColumn(name="char_card5_id", referencedColumnName="id")
     */
    protected $char_card5_id;

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
    public function getCharCard1Id()
    {
        return $this->char_card1_id;
    }

    /**
     * @param mixed $char_card1_id
     */
    public function setCharCard1Id($char_card1_id): void
    {
        $this->char_card1_id = $char_card1_id;
    }

    /**
     * @return mixed
     */
    public function getCharCard2Id()
    {
        return $this->char_card2_id;
    }

    /**
     * @param mixed $char_card2_id
     */
    public function setCharCard2Id($char_card2_id): void
    {
        $this->char_card2_id = $char_card2_id;
    }

    /**
     * @return mixed
     */
    public function getCharCard3Id()
    {
        return $this->char_card3_id;
    }

    /**
     * @param mixed $char_card3_id
     */
    public function setCharCard3Id($char_card3_id): void
    {
        $this->char_card3_id = $char_card3_id;
    }

    /**
     * @return mixed
     */
    public function getCharCard4Id()
    {
        return $this->char_card4_id;
    }

    /**
     * @param mixed $char_card4_id
     */
    public function setCharCard4Id($char_card4_id): void
    {
        $this->char_card4_id = $char_card4_id;
    }

    /**
     * @return mixed
     */
    public function getCharCard5Id()
    {
        return $this->char_card5_id;
    }

    /**
     * @param mixed $char_card5_id
     */
    public function setCharCard5Id($char_card5_id): void
    {
        $this->char_card5_id = $char_card5_id;
    }
}

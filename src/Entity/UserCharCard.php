<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserCharCardRepository")
 */
class UserCharCard
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="char_cards")
     * @ORM\JoinColumn(name="char_card_id", referencedColumnName="id")
     */
    protected $char_card_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="favorite_card")
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="most_defeated_card")
     */
    protected $user_char_cards;

    public function __construct()
    {
        $this->user_char_cards = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $card_kills;

    /**
     * @ORM\Column(type="integer")
     */
    protected $card_deaths;

    /**
     * @ORM\Column(type="integer")
     */
    protected $card_count;

    /**
     * @ORM\Column(type="integer")
     */
    protected $card_uses;

    /**
     * @return mixed
     */
    public function getCharCardId()
    {
        return $this->char_card_id;
    }

    /**
     * @param mixed $char_card_id
     */
    public function setCharCardId(CharCard $char_card_id): void
    {
        $this->char_card_id = $char_card_id;
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
    public function getCardKills()
    {
        return $this->card_kills;
    }

    /**
     * @param mixed $card_kills
     */
    public function setCardKills($card_kills): void
    {
        $this->card_kills = $card_kills;
    }

    /**
     * @return mixed
     */
    public function getCardDeaths()
    {
        return $this->card_deaths;
    }

    /**
     * @param mixed $card_deaths
     */
    public function setCardDeaths($card_deaths): void
    {
        $this->card_deaths = $card_deaths;
    }

    /**
     * @return mixed
     */
    public function getCardCount()
    {
        return $this->card_count;
    }

    /**
     * @param mixed $card_count
     */
    public function setCardCount($card_count): void
    {
        $this->card_count = $card_count;
    }

    /**
     * @return mixed
     */
    public function getCardUses()
    {
        return $this->card_uses;
    }

    /**
     * @param mixed $card_uses
     */
    public function setCardUses($card_uses): void
    {
        $this->card_uses = $card_uses;
    }
}

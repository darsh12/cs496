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
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="id")
     */
    private $user_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="CharCard", mappedBy="id")
     * @ORM\ManyToOne(targetEntity="UserStat", inversedBy="favorite_card")
     * @ORM\ManyToOne(targetEntity="UserStat", inversedBy="most_defeated_card")
     * @ORM\JoinColumn(nullable=true)
     */
    private $char_card_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_kills;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_deaths;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_count;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_uses;

    /**
     * UserCharCard constructor.
     * @param $user_id
     * @param $char_card_id
     */
    public function __construct($user_id, $char_card_id)
    {
        $this->user_id = new ArrayCollection();
        $this->char_card_id = new ArrayCollection();
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
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

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
    public function setCharCardId($char_card_id): void
    {
        $this->char_card_id = $char_card_id;
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

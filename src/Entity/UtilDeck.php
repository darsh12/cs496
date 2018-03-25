<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UtilDeckRepository")
 */
class UtilDeck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="defend_util_deck_id")
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attack_util_deck_id")
     */
    protected $util_decks;

    public function __construct()
    {
        $this->util_decks = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard", inversedBy="util_cards")
     * @ORM\JoinColumn(name="card1_id", referencedColumnName="id")
     */
    protected $card1_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard", inversedBy="util_cards")
     * @ORM\JoinColumn(name="card2_id", referencedColumnName="id")
     */
    protected $card2_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard", inversedBy="util_cards")
     * @ORM\JoinColumn(name="card3_id", referencedColumnName="id")
     */
    protected $card3_id;

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
    public function getCard1Id()
    {
        return $this->card1_id;
    }

    /**
     * @param mixed $card1_id
     */
    public function setCard1Id(UtilCard $card1_id): void
    {
        $this->card1_id = $card1_id;
    }

    /**
     * @return mixed
     */
    public function getCard2Id()
    {
        return $this->card2_id;
    }

    /**
     * @param mixed $card2_id
     */
    public function setCard2Id(UtilCard $card2_id): void
    {
        $this->card2_id = $card2_id;
    }

    /**
     * @return mixed
     */
    public function getCard3Id()
    {
        return $this->card3_id;
    }

    /**
     * @param mixed $card3_id
     */
    public function setCard3Id(UtilCard $card3_id): void
    {
        $this->card3_id = $card3_id;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilDeckRepository")
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
     */
    protected $defend_util_decks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attack_util_deck_id")
     */
    protected $attack_util_decks;

    public function __construct()
    {
        $this->defend_util_decks = new ArrayCollection();
        $this->attack_util_decks = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getDefendUtilDecks()
    {
        return $this->defend_util_decks;
    }

    /**
     * @return Collection
     */
    public function getAttackUtilDecks()
    {
        return $this->attack_util_decks;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="util_deck_users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard", inversedBy="utilDeck_card1")
     * @ORM\JoinColumn(name="util_card1_id", referencedColumnName="id")
     */
    protected $util_card1_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard", inversedBy="utilDeck_card2")
     * @ORM\JoinColumn(name="util_card2_id", referencedColumnName="id")
     */
    protected $util_card2_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard", inversedBy="utilDeck_card3")
     * @ORM\JoinColumn(name="util_card3_id", referencedColumnName="id")
     */
    protected $util_card3_id;

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
    public function getUtilCard1Id()
    {
        return $this->util_card1_id;
    }

    /**
     * @param mixed $util_card1_id
     */
    public function setUtilCard1Id($util_card1_id): void
    {
        $this->util_card1_id = $util_card1_id;
    }

    /**
     * @return mixed
     */
    public function getUtilCard2Id()
    {
        return $this->util_card2_id;
    }

    /**
     * @param mixed $util_card2_id
     */
    public function setUtilCard2Id($util_card2_id): void
    {
        $this->util_card2_id = $util_card2_id;
    }

    /**
     * @return mixed
     */
    public function getUtilCard3Id()
    {
        return $this->util_card3_id;
    }

    /**
     * @param mixed $util_card3_id
     */
    public function setUtilCard3Id($util_card3_id): void
    {
        $this->util_card3_id = $util_card3_id;
    }
}

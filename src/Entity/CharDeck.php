<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CharDeckRepository")
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
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attack_char_deck_id")
     */
    protected $char_decks;

    public function __construct()
    {
        $this->char_decks = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="char_cards")
     * @ORM\JoinColumn(name="card1_id", referencedColumnName="id")
     */
    protected $card1_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="char_cards")
     * @ORM\JoinColumn(name="card2_id", referencedColumnName="id")
     */
    protected $card2_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="char_cards")
     * @ORM\JoinColumn(name="card3_id", referencedColumnName="id")
     */
    protected $card3_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="char_cards")
     * @ORM\JoinColumn(name="card4_id", referencedColumnName="id")
     */
    protected $card4_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="char_cards")
     * @ORM\JoinColumn(name="card5_id", referencedColumnName="id")
     */
    protected $card5_id;

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
    public function setCard1Id(CharCard $card1_id): void
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
    public function setCard2Id(CharCard $card2_id): void
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
    public function setCard3Id(CharCard $card3_id): void
    {
        $this->card3_id = $card3_id;
    }

    /**
     * @return mixed
     */
    public function getCard4Id()
    {
        return $this->card4_id;
    }

    /**
     * @param mixed $card4_id
     */
    public function setCard4Id(CharCard $card4_id): void
    {
        $this->card4_id = $card4_id;
    }

    /**
     * @return mixed
     */
    public function getCard5Id()
    {
        return $this->card5_id;
    }

    /**
     * @param mixed $card5_id
     */
    public function setCard5Id(CharCard $card5_id): void
    {
        $this->card5_id = $card5_id;
    }
}

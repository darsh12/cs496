<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Migrations\Configuration\ArrayConfiguration;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CharDeckRepository")
 * @ORM\Entity
 * @ORM\Table(name="char_deck")
 */
class CharDeck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Battle", inversedBy="defend_char_deck_id")
     * @ORM\ManyToOne(targetEntity="BattleRequest", inversedBy="attack_char_deck_id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="id")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="CharCard", mappedBy="id")
     */
    private $card1_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="CharCard", mappedBy="id")
     */
    private $card2_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="CharCard", mappedBy="id")
     */
    private $card3_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="CharCard", mappedBy="id")
     */
    private $card4_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="CharCard", mappedBy="id")
     */
    private $card5_id;

    /**
     * CharDeck constructor.
     * @param $user_id
     * @param $card1_id
     * @param $card2_id
     * @param $card3_id
     * @param $card4_id
     * @param $card5_id
     */
    public function __construct($user_id, $card1_id, $card2_id, $card3_id, $card4_id, $card5_id)
    {
        $this->user_id = new ArrayCollection();
        $this->card1_id = new ArrayCollection();
        $this->card2_id = new ArrayCollection();
        $this->card3_id = new ArrayCollection();
        $this->card4_id = new ArrayCollection();
        $this->card5_id = new ArrayCollection();
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
    public function getCard1Id()
    {
        return $this->card1_id;
    }

    /**
     * @param mixed $card1_id
     */
    public function setCard1Id($card1_id): void
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
    public function setCard2Id($card2_id): void
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
    public function setCard3Id($card3_id): void
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
    public function setCard4Id($card4_id): void
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
    public function setCard5Id($card5_id): void
    {
        $this->card5_id = $card5_id;
    }
}

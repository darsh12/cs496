<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="BattleRequestRepository")
 */
class BattleRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="request_id")
     */
    protected $battle_requests;

    public function __construct()
    {
        $this->battle_requests = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(name="attacker_id", referencedColumnName="id")
     */
    protected $attacker_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(name="defender_id", referencedColumnName="id")
     */
    protected $defender_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $datetime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharDeck", inversedBy="char_decks")
     * @ORM\JoinColumn(name="attack_char_deck_id", referencedColumnName="id")
     */
    protected $attack_char_deck_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilDeck", inversedBy="util_decks")
     * @ORM\JoinColumn(name="attack_util_deck_id", referencedColumnName="id")
     */
    protected $attack_util_deck_id;

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
    public function getAttackerId()
    {
        return $this->attacker_id;
    }

    /**
     * @param mixed $attacker_id
     */
    public function setAttackerId(User $attacker_id): void
    {
        $this->attacker_id = $attacker_id;
    }

    /**
     * @return mixed
     */
    public function getDefenderId()
    {
        return $this->defender_id;
    }

    /**
     * @param mixed $defender_id
     */
    public function setDefenderId(User $defender_id): void
    {
        $this->defender_id = $defender_id;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getAttackCharDeckId()
    {
        return $this->attack_char_deck_id;
    }

    /**
     * @param mixed $attack_char_deck_id
     */
    public function setAttackCharDeckId(CharDeck $attack_char_deck_id): void
    {
        $this->attack_char_deck_id = $attack_char_deck_id;
    }

    /**
     * @return mixed
     */
    public function getAttackUtilDeckId()
    {
        return $this->attack_util_deck_id;
    }

    /**
     * @param mixed $attack_util_deck_id
     */
    public function setAttackUtilDeckId(UtilDeck $attack_util_deck_id): void
    {
        $this->attack_util_deck_id = $attack_util_deck_id;
    }
}

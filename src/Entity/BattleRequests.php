<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BattleRequestsRepository")
 */
class BattleRequests
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\Battles", inversedBy="request_id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\UserLogin", mappedBy="id")
     */
    private $attacker_id;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\UserLogin", mappedBy="id")
     */
    private $defender_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\CharDecks", mappedBy="id")
     */
    private $attack_char_deck_id;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\UtilDecks", mappedBy="id")
     */
    private $attack_util_deck_id;

    /**
     * BattleRequests constructor.
     * @param $attacker_id
     * @param $defender_id
     * @param $attack_char_deck_id
     * @param $attack_util_deck_id
     */
    public function __construct($attacker_id, $defender_id, $attack_char_deck_id, $attack_util_deck_id)
    {
        $this->attacker_id = new ArrayCollection();
        $this->defender_id = new ArrayCollection();
        $this->attack_char_deck_id = new ArrayCollection();
        $this->attack_util_deck_id = new ArrayCollection();
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
    public function getAttackerId()
    {
        return $this->attacker_id;
    }

    /**
     * @param mixed $attacker_id
     */
    public function setAttackerId($attacker_id): void
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
    public function setDefenderId($defender_id): void
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
    public function setAttackCharDeckId($attack_char_deck_id): void
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
    public function setAttackUtilDeckId($attack_util_deck_id): void
    {
        $this->attack_util_deck_id = $attack_util_deck_id;
    }
}

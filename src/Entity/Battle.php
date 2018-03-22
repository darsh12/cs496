<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="BattleRepository")
 */
class Battle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="UserStat", inversedBy="best_win_battle")
     * @ORM\ManyToOne(targetEntity="UserStat", inversedBy="worst_lost_battle")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="id")
     */
    private $winner_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $battle_datetime;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="id")
     */
    private $defend_char_deck_id;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\UtilDeck", mappedBy="id")
     */
    private $defend_util_deck_id;

    /**
     * @ORM\Column(type="string")
     */
    private $battle_report;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="id")
     */
    private $request_id;

    /**
     * Battle constructor.
     * @param $winner_id
     * @param $defend_char_deck_id
     * @param $defend_util_deck_id
     * @param $request_id
     */
    public function __construct($winner_id, $defend_char_deck_id, $defend_util_deck_id, $request_id)
    {
        $this->winner_id = new ArrayCollection();
        $this->defend_char_deck_id = new ArrayCollection();
        $this->defend_util_deck_id = new ArrayCollection();
        $this->request_id = new ArrayCollection();
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
    public function getWinnerId()
    {
        return $this->winner_id;
    }

    /**
     * @param mixed $winner_id
     */
    public function setWinnerId($winner_id): void
    {
        $this->winner_id = $winner_id;
    }

    /**
     * @return mixed
     */
    public function getBattleDatetime()
    {
        return $this->battle_datetime;
    }

    /**
     * @param mixed $battle_datetime
     */
    public function setBattleDatetime($battle_datetime): void
    {
        $this->battle_datetime = $battle_datetime;
    }

    /**
     * @return mixed
     */
    public function getDefendCharDeckId()
    {
        return $this->defend_char_deck_id;
    }

    /**
     * @param mixed $defend_char_deck_id
     */
    public function setDefendCharDeckId($defend_char_deck_id): void
    {
        $this->defend_char_deck_id = $defend_char_deck_id;
    }

    /**
     * @return mixed
     */
    public function getDefendUtilDeckId()
    {
        return $this->defend_util_deck_id;
    }

    /**
     * @param mixed $defend_util_deck_id
     */
    public function setDefendUtilDeckId($defend_util_deck_id): void
    {
        $this->defend_util_deck_id = $defend_util_deck_id;
    }

    /**
     * @return mixed
     */
    public function getBattleReport()
    {
        return $this->battle_report;
    }

    /**
     * @param mixed $battle_report
     */
    public function setBattleReport($battle_report): void
    {
        $this->battle_report = $battle_report;
    }

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * @param mixed $request_id
     */
    public function setRequestId($request_id): void
    {
        $this->request_id = $request_id;
    }
}

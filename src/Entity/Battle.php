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
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="best_win_battle")
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="worst_lost_battle")
     */
    protected $battles;

    public function __construct()
    {
        $this->battles = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     * @ORM\JoinColumn(name="winner_id", referencedColumnName="id")
     */
    protected $winner_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $battle_datetime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharDeck", inversedBy="char_decks")
     * @ORM\JoinColumn(name="defend_char_deck_id", referencedColumnName="id")
     */
    protected $defend_char_deck_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilDeck")
     * @ORM\JoinColumn(name="defend_util_deck_id", referencedColumnName="id")
     */
    protected $defend_util_deck_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $battle_report;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BattleRequest")
     * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
     */
    protected $request_id;

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
    public function setWinnerId(User $winner_id): void
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
    public function setDefendCharDeckId(CharDeck $defend_char_deck_id): void
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
    public function setDefendUtilDeckId(UtilDeck $defend_util_deck_id): void
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
    public function setRequestId(BattleRequest $request_id): void
    {
        $this->request_id = $request_id;
    }
}

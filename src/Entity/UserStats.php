<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserStatsRepository")
 */
class UserStats
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="id")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_rank;

    /**
     * @ORM\Column(type="time")
     */
    private $user_level;

    /**
     * @ORM\Column(type="integer")
     */
    private $play_time;

    /**
     * @ORM\Column(type="integer")
     */
    private $matches_won;

    /**
     * @ORM\Column(type="decimal")
     */
    private $matches_lost;

    /**
     * @ORM\Column(type="integer")
     */
    private $win_loss_ratio;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\UserCharCards", mappedBy="char_card_id")
     */
    private $favorite_card;

    /**
     * @ORM\Column(type="integer")
     */
    private $times_attacked;

    /**
     * @ORM\Column(type="integer")
     */
    private $times_defended;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\Battles", mappedBy="id")
     */
    private $best_win_battle;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\Battles", mappedBy="id")
     */
    private $worst_lost_battle;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\UserCharCards", mappedBy="char_card_id")
     */
    private $most_defeated_card;

    /**
     * UserStats constructor.
     * @param $user_id
     * @param $favorite_card
     * @param $best_win_battle
     * @param $worst_lost_battle
     * @param $most_defeated_card
     */
    public function __construct($user_id, $favorite_card, $best_win_battle, $worst_lost_battle, $most_defeated_card)
    {
        $this->user_id = new ArrayCollection();
        $this->favorite_card = new ArrayCollection();
        $this->best_win_battle = new ArrayCollection();
        $this->worst_lost_battle = new ArrayCollection();
        $this->most_defeated_card = new ArrayCollection();
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
    public function getUserRank()
    {
        return $this->user_rank;
    }

    /**
     * @param mixed $user_rank
     */
    public function setUserRank($user_rank): void
    {
        $this->user_rank = $user_rank;
    }

    /**
     * @return mixed
     */
    public function getUserLevel()
    {
        return $this->user_level;
    }

    /**
     * @param mixed $user_level
     */
    public function setUserLevel($user_level): void
    {
        $this->user_level = $user_level;
    }

    /**
     * @return mixed
     */
    public function getPlayTime()
    {
        return $this->play_time;
    }

    /**
     * @param mixed $play_time
     */
    public function setPlayTime($play_time): void
    {
        $this->play_time = $play_time;
    }

    /**
     * @return mixed
     */
    public function getMatchesWon()
    {
        return $this->matches_won;
    }

    /**
     * @param mixed $matches_won
     */
    public function setMatchesWon($matches_won): void
    {
        $this->matches_won = $matches_won;
    }

    /**
     * @return mixed
     */
    public function getMatchesLost()
    {
        return $this->matches_lost;
    }

    /**
     * @param mixed $matches_lost
     */
    public function setMatchesLost($matches_lost): void
    {
        $this->matches_lost = $matches_lost;
    }

    /**
     * @return mixed
     */
    public function getWinLossRatio()
    {
        return $this->win_loss_ratio;
    }

    /**
     * @param mixed $win_loss_ratio
     */
    public function setWinLossRatio($win_loss_ratio): void
    {
        $this->win_loss_ratio = $win_loss_ratio;
    }

    /**
     * @return mixed
     */
    public function getFavoriteCard()
    {
        return $this->favorite_card;
    }

    /**
     * @param mixed $favorite_card
     */
    public function setFavoriteCard($favorite_card): void
    {
        $this->favorite_card = $favorite_card;
    }

    /**
     * @return mixed
     */
    public function getTimesAttacked()
    {
        return $this->times_attacked;
    }

    /**
     * @param mixed $times_attacked
     */
    public function setTimesAttacked($times_attacked): void
    {
        $this->times_attacked = $times_attacked;
    }

    /**
     * @return mixed
     */
    public function getTimesDefended()
    {
        return $this->times_defended;
    }

    /**
     * @param mixed $times_defended
     */
    public function setTimesDefended($times_defended): void
    {
        $this->times_defended = $times_defended;
    }

    /**
     * @return mixed
     */
    public function getBestWinBattle()
    {
        return $this->best_win_battle;
    }

    /**
     * @param mixed $best_win_battle
     */
    public function setBestWinBattle($best_win_battle): void
    {
        $this->best_win_battle = $best_win_battle;
    }

    /**
     * @return mixed
     */
    public function getWorstLostBattle()
    {
        return $this->worst_lost_battle;
    }

    /**
     * @param mixed $worst_lost_battle
     */
    public function setWorstLostBattle($worst_lost_battle): void
    {
        $this->worst_lost_battle = $worst_lost_battle;
    }

    /**
     * @return mixed
     */
    public function getMostDefeatedCard()
    {
        return $this->most_defeated_card;
    }

    /**
     * @param mixed $most_defeated_card
     */
    public function setMostDefeatedCard($most_defeated_card): void
    {
        $this->most_defeated_card = $most_defeated_card;
    }
}

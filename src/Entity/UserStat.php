<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserStatRepository")
 */
class UserStat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userStats")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="userStats_favouriteCard")
     */
    private $favourite_char_card;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilCards", inversedBy="userStats_favouriteCard")
     */
    private $favourite_util_card;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Battle", inversedBy="userStats_bestWin")
     */
    private $best_win_battle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Battle", inversedBy="userStats_worstLost")
     */
    private $worst_lost_battle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="userStats_defeatedCards")
     */
    private $defeated_char_card;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilCards", inversedBy="userStats_defeatedCards")
     */
    private $defeated_util_card;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_rank=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_level=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $matches_won=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $matches_lost=0;

    /**
     * @ORM\Column(type="decimal", precision=5)
     */
    private $win_loss_ratio=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $times_attacked=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $experience=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $times_defended=0;



    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFavouriteCharCard(): ?UserCharCards
    {
        return $this->favourite_char_card;
    }

    public function setFavouriteCharCard(?UserCharCards $favourite_char_card): self
    {
        $this->favourite_char_card = $favourite_char_card;

        return $this;
    }

    public function getFavouriteUtilCard(): ?UserUtilCards
    {
        return $this->favourite_util_card;
    }

    public function setFavouriteUtilCard(?UserUtilCards $favourite_util_card): self
    {
        $this->favourite_util_card = $favourite_util_card;

        return $this;
    }

    public function getBestWinBattle(): ?Battle
    {
        return $this->best_win_battle;
    }

    public function setBestWinBattle(?Battle $best_win_battle): self
    {
        $this->best_win_battle = $best_win_battle;

        return $this;
    }

    public function getWorstLostBattle(): ?Battle
    {
        return $this->worst_lost_battle;
    }

    public function setWorstLostBattle(?Battle $worst_lost_battle): self
    {
        $this->worst_lost_battle = $worst_lost_battle;

        return $this;
    }

    public function getDefeatedCharCard(): ?UserCharCards
    {
        return $this->defeated_char_card;
    }

    public function setDefeatedCharCard(?UserCharCards $defeated_char_card): self
    {
        $this->defeated_char_card = $defeated_char_card;

        return $this;
    }

    public function getDefeatedUtilCard(): ?UserUtilCards
    {
        return $this->defeated_util_card;
    }

    public function setDefeatedUtilCard(?UserUtilCards $defeated_util_card): self
    {
        $this->defeated_util_card = $defeated_util_card;

        return $this;
    }

    public function getUserRank(): ?int
    {
        return $this->user_rank;
    }

    public function setUserRank(int $user_rank): self
    {
        $this->user_rank = $user_rank;

        return $this;
    }

    public function getUserLevel(): ?int
    {
        return $this->user_level;
    }

    public function setUserLevel(int $user_level): self
    {
        $this->user_level = $user_level;

        return $this;
    }

    public function getMatchesWon(): ?int
    {
        return $this->matches_won;
    }

    public function setMatchesWon(int $matches_won): self
    {
        $this->matches_won = $matches_won;

        return $this;
    }

    public function getMatchesLost(): ?int
    {
        return $this->matches_lost;
    }

    public function setMatchesLost(int $matches_lost): self
    {
        $this->matches_lost = $matches_lost;

        return $this;
    }

    public function getWinLossRatio()
    {
        return $this->win_loss_ratio;
    }

    public function setWinLossRatio($win_loss_ratio): self
    {
        $this->win_loss_ratio = $win_loss_ratio;

        return $this;
    }

    public function getTimesAttacked(): ?int
    {
        return $this->times_attacked;
    }

    public function setTimesAttacked(int $times_attacked): self
    {
        $this->times_attacked = $times_attacked;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getTimesDefended(): ?int
    {
        return $this->times_defended;
    }

    public function setTimesDefended(int $times_defended): self
    {
        $this->times_defended = $times_defended;

        return $this;
    }
}

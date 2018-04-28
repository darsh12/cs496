<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BattleRepository")
 */
class Battle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="battle_winner")
     */
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharDecks", inversedBy="battles_defender")
     */
    private $defend_char_deck;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilDecks", inversedBy="battles_defender")
     */
    private $defend_util_deck;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BattleRequest", inversedBy="battles")
     */
    private $request;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $report="No reports right now";

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="best_win_battle")
     */
    private $userStats_bestWin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="worst_lost_battle")
     */
    private $userStats_worstLost;

    /**
     * @ORM\Column(type="boolean")
     */
    private $viewed=false;

    public function __construct()
    {
        $this->time = new \DateTime();
        $this->userStats_bestWin = new ArrayCollection();
        $this->userStats_worstLost = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getWinner(): ?User
    {
        return $this->winner;
    }

    public function setWinner(?User $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getDefendCharDeck(): ?UserCharDecks
    {
        return $this->defend_char_deck;
    }

    public function setDefendCharDeck(?UserCharDecks $defend_char_deck): self
    {
        $this->defend_char_deck = $defend_char_deck;

        return $this;
    }

    public function getDefendUtilDeck(): ?UserUtilDecks
    {
        return $this->defend_util_deck;
    }

    public function setDefendUtilDeck(?UserUtilDecks $defend_util_deck): self
    {
        $this->defend_util_deck = $defend_util_deck;

        return $this;
    }

    public function getRequest(): ?BattleRequest
    {
        return $this->request;
    }

    public function setRequest(?BattleRequest $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(string $report): self
    {
        $this->report = $report;

        return $this;
    }

    /**
     * @return Collection|UserStat[]
     */
    public function getUserStatsBestWin(): Collection
    {
        return $this->userStats_bestWin;
    }

    public function addUserStatsBestWin(UserStat $userStatsBestWin): self
    {
        if (!$this->userStats_bestWin->contains($userStatsBestWin)) {
            $this->userStats_bestWin[] = $userStatsBestWin;
            $userStatsBestWin->setBestWinBattle($this);
        }

        return $this;
    }

    public function removeUserStatsBestWin(UserStat $userStatsBestWin): self
    {
        if ($this->userStats_bestWin->contains($userStatsBestWin)) {
            $this->userStats_bestWin->removeElement($userStatsBestWin);
            // set the owning side to null (unless already changed)
            if ($userStatsBestWin->getBestWinBattle() === $this) {
                $userStatsBestWin->setBestWinBattle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserStat[]
     */
    public function getUserStatsWorstLost(): Collection
    {
        return $this->userStats_worstLost;
    }

    public function addUserStatsWorstLost(UserStat $userStatsWorstLost): self
    {
        if (!$this->userStats_worstLost->contains($userStatsWorstLost)) {
            $this->userStats_worstLost[] = $userStatsWorstLost;
            $userStatsWorstLost->setWorstLostBattle($this);
        }

        return $this;
    }

    public function removeUserStatsWorstLost(UserStat $userStatsWorstLost): self
    {
        if ($this->userStats_worstLost->contains($userStatsWorstLost)) {
            $this->userStats_worstLost->removeElement($userStatsWorstLost);
            // set the owning side to null (unless already changed)
            if ($userStatsWorstLost->getWorstLostBattle() === $this) {
                $userStatsWorstLost->setWorstLostBattle(null);
            }
        }

        return $this;
    }

    public function getViewed(): ?bool
    {
        return $this->viewed;
    }

    public function setViewed(bool $viewed): self
    {
        $this->viewed = $viewed;

        return $this;
    }
}

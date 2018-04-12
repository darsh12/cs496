<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserUtilDecksRepository")
 */
class UserUtilDecks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilCards", inversedBy="userUtilDecks_card1")
     */
    private $card1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilCards", inversedBy="userUtilDecks_card2")
     */
    private $card2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilCards", inversedBy="userUtilDecks_card3")
     */
    private $card3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userUtilDecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attacker_util_deck")
     */
    private $battlerRequests_attacker;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="defend_util_deck")
     */
    private $battles_defender;

    public function __construct()
    {
        $this->battlerRequests_attacker = new ArrayCollection();
        $this->battles_defender = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCard1(): ?UserUtilCards
    {
        return $this->card1;
    }

    public function setCard1(?UserUtilCards $card1): self
    {
        $this->card1 = $card1;

        return $this;
    }

    public function getCard2(): ?UserUtilCards
    {
        return $this->card2;
    }

    public function setCard2(?UserUtilCards $card2): self
    {
        $this->card2 = $card2;

        return $this;
    }

    public function getCard3(): ?UserUtilCards
    {
        return $this->card3;
    }

    public function setCard3(?UserUtilCards $card3): self
    {
        $this->card3 = $card3;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    /**
     * @return Collection|BattleRequest[]
     */
    public function getBattlerRequestsAttacker(): Collection
    {
        return $this->battlerRequests_attacker;
    }

    public function addBattlerRequestsAttacker(BattleRequest $battlerRequestsAttacker): self
    {
        if (!$this->battlerRequests_attacker->contains($battlerRequestsAttacker)) {
            $this->battlerRequests_attacker[] = $battlerRequestsAttacker;
            $battlerRequestsAttacker->setAttackerUtilDeck($this);
        }

        return $this;
    }

    public function removeBattlerRequestsAttacker(BattleRequest $battlerRequestsAttacker): self
    {
        if ($this->battlerRequests_attacker->contains($battlerRequestsAttacker)) {
            $this->battlerRequests_attacker->removeElement($battlerRequestsAttacker);
            // set the owning side to null (unless already changed)
            if ($battlerRequestsAttacker->getAttackerUtilDeck() === $this) {
                $battlerRequestsAttacker->setAttackerUtilDeck(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Battle[]
     */
    public function getBattlesDefender(): Collection
    {
        return $this->battles_defender;
    }

    public function addBattlesDefender(Battle $battlesDefender): self
    {
        if (!$this->battles_defender->contains($battlesDefender)) {
            $this->battles_defender[] = $battlesDefender;
            $battlesDefender->setDefendUtilDeck($this);
        }

        return $this;
    }

    public function removeBattlesDefender(Battle $battlesDefender): self
    {
        if ($this->battles_defender->contains($battlesDefender)) {
            $this->battles_defender->removeElement($battlesDefender);
            // set the owning side to null (unless already changed)
            if ($battlesDefender->getDefendUtilDeck() === $this) {
                $battlesDefender->setDefendUtilDeck(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCharDecksRepository")
 */
class UserCharDecks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="userDecks_card1")
     * @ORM\JoinColumn(nullable=false)
     */
    private $card1;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="userDecks_card2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $card2;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="userDecks_card3")
     * @ORM\JoinColumn(nullable=false)
     */
    private $card3;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="userDecks_card4")
     * @ORM\JoinColumn(nullable=false)
     */
    private $card4;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharCards", inversedBy="userDecks_card5")
     * @ORM\JoinColumn(nullable=false)
     */
    private $card5;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userCharDecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attacker_char_deck")
     */
    private $battleRequests_attacker;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="defend_char_deck")
     */
    private $battles_defender;

    public function __construct()
    {
        $this->battleRequests_attacker = new ArrayCollection();
        $this->battles_defender = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getCard1(): ?UserCharCards
    {
        return $this->card1;
    }

    public function setCard1(?UserCharCards $card1): self
    {
        $this->card1 = $card1;

        return $this;
    }

    public function getCard2(): ?UserCharCards
    {
        return $this->card2;
    }

    public function setCard2(?UserCharCards $card2): self
    {
        $this->card2 = $card2;

        return $this;
    }

    public function getCard3(): ?UserCharCards
    {
        return $this->card3;
    }

    public function setCard3(?UserCharCards $card3): self
    {
        $this->card3 = $card3;

        return $this;
    }

    public function getCard4(): ?UserCharCards
    {
        return $this->card4;
    }

    public function setCard4(?UserCharCards $card4): self
    {
        $this->card4 = $card4;

        return $this;
    }

    public function getCard5(): ?UserCharCards
    {
        return $this->card5;
    }

    public function setCard5(?UserCharCards $card5): self
    {
        $this->card5 = $card5;

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
    public function getBattleRequestsAttacker(): Collection
    {
        return $this->battleRequests_attacker;
    }

    public function addBattleRequestsAttacker(BattleRequest $battleRequestsAttacker): self
    {
        if (!$this->battleRequests_attacker->contains($battleRequestsAttacker)) {
            $this->battleRequests_attacker[] = $battleRequestsAttacker;
            $battleRequestsAttacker->setAttackerCharDeck($this);
        }

        return $this;
    }

    public function removeBattleRequestsAttacker(BattleRequest $battleRequestsAttacker): self
    {
        if ($this->battleRequests_attacker->contains($battleRequestsAttacker)) {
            $this->battleRequests_attacker->removeElement($battleRequestsAttacker);
            // set the owning side to null (unless already changed)
            if ($battleRequestsAttacker->getAttackerCharDeck() === $this) {
                $battleRequestsAttacker->setAttackerCharDeck(null);
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
            $battlesDefender->setDefendCharDeck($this);
        }

        return $this;
    }

    public function removeBattlesDefender(Battle $battlesDefender): self
    {
        if ($this->battles_defender->contains($battlesDefender)) {
            $this->battles_defender->removeElement($battlesDefender);
            // set the owning side to null (unless already changed)
            if ($battlesDefender->getDefendCharDeck() === $this) {
                $battlesDefender->setDefendCharDeck(null);
            }
        }

        return $this;
    }
}

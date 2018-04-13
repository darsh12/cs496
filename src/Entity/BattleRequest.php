<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BattleRequestRepository")
 */
class BattleRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="battleRequests_attacker")
     */
    private $attacker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="battlerRequests_defender")
     */
    private $defender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharDecks", inversedBy="battleRequests_attacker")
     */
    private $attacker_char_deck;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilDecks", inversedBy="battlerRequests_attacker")
     */
    private $attacker_util_deck;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="request")
     */
    private $battles;

    public function __construct()
    {
        $this->time = new \DateTime();
        $this->battles = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAttacker(): ?User
    {
        return $this->attacker;
    }

    public function setAttacker(?User $attacker): self
    {
        $this->attacker = $attacker;

        return $this;
    }

    public function getDefender(): ?User
    {
        return $this->defender;
    }

    public function setDefender(?User $defender): self
    {
        $this->defender = $defender;

        return $this;
    }

    public function getAttackerCharDeck(): ?UserCharDecks
    {
        return $this->attacker_char_deck;
    }

    public function setAttackerCharDeck(?UserCharDecks $attacker_char_deck): self
    {
        $this->attacker_char_deck = $attacker_char_deck;

        return $this;
    }

    public function getAttackerUtilDeck(): ?UserUtilDecks
    {
        return $this->attacker_util_deck;
    }

    public function setAttackerUtilDeck(?UserUtilDecks $attacker_util_deck): self
    {
        $this->attacker_util_deck = $attacker_util_deck;

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

    /**
     * @return Collection|Battle[]
     */
    public function getBattles(): Collection
    {
        return $this->battles;
    }

    public function addBattle(Battle $battle): self
    {
        if (!$this->battles->contains($battle)) {
            $this->battles[] = $battle;
            $battle->setRequest($this);
        }

        return $this;
    }

    public function removeBattle(Battle $battle): self
    {
        if ($this->battles->contains($battle)) {
            $this->battles->removeElement($battle);
            // set the owning side to null (unless already changed)
            if ($battle->getRequest() === $this) {
                $battle->setRequest(null);
            }
        }

        return $this;
    }
}

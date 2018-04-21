<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCharCardsRepository")
 */
class UserCharCards
{


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCard", inversedBy="userCharCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $char_card;


    /**
     * @ORM\Column(type="integer")
     */
    private $card_count = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharDecks", mappedBy="card1")
     */
    private $userDecks_card1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharDecks", mappedBy="card2")
     */
    private $userDecks_card2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharDecks", mappedBy="card3")
     */
    private $userDecks_card3;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharDecks", mappedBy="card4")
     */
    private $userDecks_card4;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharDecks", mappedBy="card5")
     */
    private $userDecks_card5;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userCharCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_kill=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_death=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_uses=0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="favourite_char_card")
     */
    private $userStats_favouriteCard;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="defeated_char_card")
     */
    private $userStats_defeatedCards;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_deck_uses=0;


    public function __construct()
    {
        $this->userDecks_card2 = new ArrayCollection();
        $this->userDecks_card1 = new ArrayCollection();
        $this->userDecks_card3 = new ArrayCollection();
        $this->userDecks_card4 = new ArrayCollection();
        $this->userDecks_card5 = new ArrayCollection();
        $this->userStats_favouriteCard = new ArrayCollection();
        $this->userStats_defeatedCards = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCharCard(): ?CharCard
    {
        return $this->char_card;
    }

    public function setCharCard(?CharCard $char_card): self
    {
        $this->char_card = $char_card;

        return $this;
    }


    public function getCardCount(): ?int
    {
        return $this->card_count;
    }

    public function setCardCount(int $card_count): self
    {
        $this->card_count = $card_count;

        return $this;
    }

    /**
     * @return Collection|UserCharDecks[]
     */
    public function getUserDecksCard1(): Collection
    {
        return $this->userDecks_card1;
    }

    public function addUserDecksCard1(UserCharDecks $userDecksCard1): self
    {
        if (!$this->userDecks_card1->contains($userDecksCard1)) {
            $this->userDecks_card1[] = $userDecksCard1;
            $userDecksCard1->setCard1($this);
        }

        return $this;
    }

    public function removeUserDecksCard1(UserCharDecks $userDecksCard1): self
    {
        if ($this->userDecks_card1->contains($userDecksCard1)) {
            $this->userDecks_card1->removeElement($userDecksCard1);
            // set the owning side to null (unless already changed)
            if ($userDecksCard1->getCard1() === $this) {
                $userDecksCard1->setCard1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserCharDecks[]
     */
    public function getUserDecksCard2(): Collection
    {
        return $this->userDecks_card2;
    }

    public function addUserDecksCard2(UserCharDecks $userDecksCard2): self
    {
        if (!$this->userDecks_card2->contains($userDecksCard2)) {
            $this->userDecks_card2[] = $userDecksCard2;
            $userDecksCard2->setCard2($this);
        }

        return $this;
    }

    public function removeUserDecksCard2(UserCharDecks $userDecksCard2): self
    {
        if ($this->userDecks_card2->contains($userDecksCard2)) {
            $this->userDecks_card2->removeElement($userDecksCard2);
            // set the owning side to null (unless already changed)
            if ($userDecksCard2->getCard2() === $this) {
                $userDecksCard2->setCard2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserCharDecks[]
     */
    public function getUserDecksCard3(): Collection
    {
        return $this->userDecks_card3;
    }

    public function addUserDecksCard3(UserCharDecks $userDecksCard3): self
    {
        if (!$this->userDecks_card3->contains($userDecksCard3)) {
            $this->userDecks_card3[] = $userDecksCard3;
            $userDecksCard3->setCard3($this);
        }

        return $this;
    }

    public function removeUserDecksCard3(UserCharDecks $userDecksCard3): self
    {
        if ($this->userDecks_card3->contains($userDecksCard3)) {
            $this->userDecks_card3->removeElement($userDecksCard3);
            // set the owning side to null (unless already changed)
            if ($userDecksCard3->getCard3() === $this) {
                $userDecksCard3->setCard3(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserCharDecks[]
     */
    public function getUserDecksCard4(): Collection
    {
        return $this->userDecks_card4;
    }

    public function addUserDecksCard4(UserCharDecks $userDecksCard4): self
    {
        if (!$this->userDecks_card4->contains($userDecksCard4)) {
            $this->userDecks_card4[] = $userDecksCard4;
            $userDecksCard4->setCard4($this);
        }

        return $this;
    }

    public function removeUserDecksCard4(UserCharDecks $userDecksCard4): self
    {
        if ($this->userDecks_card4->contains($userDecksCard4)) {
            $this->userDecks_card4->removeElement($userDecksCard4);
            // set the owning side to null (unless already changed)
            if ($userDecksCard4->getCard4() === $this) {
                $userDecksCard4->setCard4(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserCharDecks[]
     */
    public function getUserDecksCard5(): Collection
    {
        return $this->userDecks_card5;
    }

    public function addUserDecksCard5(UserCharDecks $userDecksCard5): self
    {
        if (!$this->userDecks_card5->contains($userDecksCard5)) {
            $this->userDecks_card5[] = $userDecksCard5;
            $userDecksCard5->setCard5($this);
        }

        return $this;
    }

    public function removeUserDecksCard5(UserCharDecks $userDecksCard5): self
    {
        if ($this->userDecks_card5->contains($userDecksCard5)) {
            $this->userDecks_card5->removeElement($userDecksCard5);
            // set the owning side to null (unless already changed)
            if ($userDecksCard5->getCard5() === $this) {
                $userDecksCard5->setCard5(null);
            }
        }

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

    public function getCardKill(): ?int
    {
        return $this->card_kill;
    }

    public function setCardKill(int $card_kill): self
    {
        $this->card_kill = $card_kill;

        return $this;
    }

    public function getCardDeath(): ?int
    {
        return $this->card_death;
    }

    public function setCardDeath(int $card_death): self
    {
        $this->card_death = $card_death;

        return $this;
    }

    public function getCardUses(): ?int
    {
        return $this->card_uses;
    }

    public function setCardUses(int $card_uses): self
    {
        $this->card_uses = $card_uses;

        return $this;
    }

    /**
     * @return Collection|UserStat[]
     */
    public function getUserStatsFavouriteCard(): Collection
    {
        return $this->userStats_favouriteCard;
    }

    public function addUserStatsFavouriteCard(UserStat $userStatsFavouriteCard): self
    {
        if (!$this->userStats_favouriteCard->contains($userStatsFavouriteCard)) {
            $this->userStats_favouriteCard[] = $userStatsFavouriteCard;
            $userStatsFavouriteCard->setFavouriteCharCard($this);
        }

        return $this;
    }

    public function removeUserStatsFavouriteCard(UserStat $userStatsFavouriteCard): self
    {
        if ($this->userStats_favouriteCard->contains($userStatsFavouriteCard)) {
            $this->userStats_favouriteCard->removeElement($userStatsFavouriteCard);
            // set the owning side to null (unless already changed)
            if ($userStatsFavouriteCard->getFavouriteCharCard() === $this) {
                $userStatsFavouriteCard->setFavouriteCharCard(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserStat[]
     */
    public function getUserStatsDefeatedCards(): Collection
    {
        return $this->userStats_defeatedCards;
    }

    public function addUserStatsDefeatedCard(UserStat $userStatsDefeatedCard): self
    {
        if (!$this->userStats_defeatedCards->contains($userStatsDefeatedCard)) {
            $this->userStats_defeatedCards[] = $userStatsDefeatedCard;
            $userStatsDefeatedCard->setDefeatedCharCard($this);
        }

        return $this;
    }

    public function removeUserStatsDefeatedCard(UserStat $userStatsDefeatedCard): self
    {
        if ($this->userStats_defeatedCards->contains($userStatsDefeatedCard)) {
            $this->userStats_defeatedCards->removeElement($userStatsDefeatedCard);
            // set the owning side to null (unless already changed)
            if ($userStatsDefeatedCard->getDefeatedCharCard() === $this) {
                $userStatsDefeatedCard->setDefeatedCharCard(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        $name = ($this->getCharCard()->getCharName()). " : " .($this->getCharCard()->getCharTier(). " : " .(($this->card_count)-($this->card_deck_uses)) . " use left");
        return $name;

    }

    public function getCardDeckUses(): ?int
    {
        return $this->card_deck_uses;
    }

    public function setCardDeckUses(int $card_deck_uses): self
    {
        $this->card_deck_uses = $card_deck_uses;

        return $this;
    }

}

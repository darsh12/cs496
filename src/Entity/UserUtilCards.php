<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserUtilCardsRepository")
 */
class UserUtilCards
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard", inversedBy="userUtilCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $util_card;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userUtilCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_count=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_uses=0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilDecks", mappedBy="card1")
     */
    private $userUtilDecks_card1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilDecks", mappedBy="card2")
     */
    private $userUtilDecks_card2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilDecks", mappedBy="card3")
     */
    private $userUtilDecks_card3;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="favourite_util_card")
     */
    private $userStats_favouriteCard;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="defeated_util_card")
     */
    private $userStats_defeatedCards;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_defeats=0;

    public function __construct()
    {
        $this->userUtilDecks_card1 = new ArrayCollection();
        $this->userUtilDecks_card2 = new ArrayCollection();
        $this->userUtilDecks_card3 = new ArrayCollection();
        $this->userStats_favouriteCard = new ArrayCollection();
        $this->userStats_defeatedCards = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUtilCard(): ?UtilCard
    {
        return $this->util_card;
    }

    public function setUtilCard(?UtilCard $util_card): self
    {
        $this->util_card = $util_card;

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

    public function getCardCount(): ?int
    {
        return $this->card_count;
    }

    public function setCardCount(int $card_count): self
    {
        $this->card_count = $card_count;

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
     * @return Collection|UserUtilDecks[]
     */
    public function getUserUtilDecksCard1(): Collection
    {
        return $this->userUtilDecks_card1;
    }

    public function addUserUtilDecksCard1(UserUtilDecks $userUtilDecksCard1): self
    {
        if (!$this->userUtilDecks_card1->contains($userUtilDecksCard1)) {
            $this->userUtilDecks_card1[] = $userUtilDecksCard1;
            $userUtilDecksCard1->setCard1($this);
        }

        return $this;
    }

    public function removeUserUtilDecksCard1(UserUtilDecks $userUtilDecksCard1): self
    {
        if ($this->userUtilDecks_card1->contains($userUtilDecksCard1)) {
            $this->userUtilDecks_card1->removeElement($userUtilDecksCard1);
            // set the owning side to null (unless already changed)
            if ($userUtilDecksCard1->getCard1() === $this) {
                $userUtilDecksCard1->setCard1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserUtilDecks[]
     */
    public function getUserUtilDecksCard2(): Collection
    {
        return $this->userUtilDecks_card2;
    }

    public function addUserUtilDecksCard2(UserUtilDecks $userUtilDecksCard2): self
    {
        if (!$this->userUtilDecks_card2->contains($userUtilDecksCard2)) {
            $this->userUtilDecks_card2[] = $userUtilDecksCard2;
            $userUtilDecksCard2->setCard2($this);
        }

        return $this;
    }

    public function removeUserUtilDecksCard2(UserUtilDecks $userUtilDecksCard2): self
    {
        if ($this->userUtilDecks_card2->contains($userUtilDecksCard2)) {
            $this->userUtilDecks_card2->removeElement($userUtilDecksCard2);
            // set the owning side to null (unless already changed)
            if ($userUtilDecksCard2->getCard2() === $this) {
                $userUtilDecksCard2->setCard2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserUtilDecks[]
     */
    public function getUserUtilDecksCard3(): Collection
    {
        return $this->userUtilDecks_card3;
    }

    public function addUserUtilDecksCard3(UserUtilDecks $userUtilDecksCard3): self
    {
        if (!$this->userUtilDecks_card3->contains($userUtilDecksCard3)) {
            $this->userUtilDecks_card3[] = $userUtilDecksCard3;
            $userUtilDecksCard3->setCard3($this);
        }

        return $this;
    }

    public function removeUserUtilDecksCard3(UserUtilDecks $userUtilDecksCard3): self
    {
        if ($this->userUtilDecks_card3->contains($userUtilDecksCard3)) {
            $this->userUtilDecks_card3->removeElement($userUtilDecksCard3);
            // set the owning side to null (unless already changed)
            if ($userUtilDecksCard3->getCard3() === $this) {
                $userUtilDecksCard3->setCard3(null);
            }
        }

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
            $userStatsFavouriteCard->setFavouriteUtilCard($this);
        }

        return $this;
    }

    public function removeUserStatsFavouriteCard(UserStat $userStatsFavouriteCard): self
    {
        if ($this->userStats_favouriteCard->contains($userStatsFavouriteCard)) {
            $this->userStats_favouriteCard->removeElement($userStatsFavouriteCard);
            // set the owning side to null (unless already changed)
            if ($userStatsFavouriteCard->getFavouriteUtilCard() === $this) {
                $userStatsFavouriteCard->setFavouriteUtilCard(null);
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
            $userStatsDefeatedCard->setDefeatedUtilCard($this);
        }

        return $this;
    }

    public function removeUserStatsDefeatedCard(UserStat $userStatsDefeatedCard): self
    {
        if ($this->userStats_defeatedCards->contains($userStatsDefeatedCard)) {
            $this->userStats_defeatedCards->removeElement($userStatsDefeatedCard);
            // set the owning side to null (unless already changed)
            if ($userStatsDefeatedCard->getDefeatedUtilCard() === $this) {
                $userStatsDefeatedCard->setDefeatedUtilCard(null);
            }
        }

        return $this;
    }

    public function getCardDefeats(): ?int
    {
        return $this->card_defeats;
    }

    public function setCardDefeats(int $card_defeats): self
    {
        $this->card_defeats = $card_defeats;

        return $this;
    }
}

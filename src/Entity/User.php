<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser implements TwoFactorInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="googleAuthenticatorSecret", type="string", nullable=true)
     */
    protected $googleAuthenticatorSecret;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharCards", mappedBy="user", orphanRemoval=true)
     */
    private $userCharCards;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilCards", mappedBy="user", orphanRemoval=true)
     */
    private $userUtilCards;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharDecks", mappedBy="user", orphanRemoval=true)
     */
    private $userCharDecks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilDecks", mappedBy="user", orphanRemoval=true)
     */
    private $userUtilDecks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CustomCard", mappedBy="user", orphanRemoval=true)
     */
    private $customCards;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAchievement", mappedBy="user")
     */
    private $userAchievements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attacker")
     */
    private $battleRequests_attacker;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="defender")
     */
    private $battlerRequests_defender;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="winner")
     */
    private $battle_winner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="user")
     */
    private $userStats;

    /**
     * @ORM\Column(type="integer")
     */
    private $coins=0;

    public function __construct()
    {
        parent::__construct();
        $this->userCharCards = new ArrayCollection();
        $this->userUtilCards = new ArrayCollection();
        $this->userCharDecks = new ArrayCollection();
        $this->userUtilDecks = new ArrayCollection();
        $this->customCards = new ArrayCollection();
        $this->userAchievements = new ArrayCollection();
        $this->battleRequests_attacker = new ArrayCollection();
        $this->battlerRequests_defender = new ArrayCollection();
        $this->battle_winner = new ArrayCollection();
        $this->userStats = new ArrayCollection();
    }



    public function isGoogleAuthenticatorEnabled(): bool
    {
        return $this->googleAuthenticatorSecret ? true : false;
    }

    public function getGoogleAuthenticatorUsername(): string
    {
        return $this->username;
    }

    public function getGoogleAuthenticatorSecret(): string
    {
        return $this->googleAuthenticatorSecret;
    }

    public function setGoogleAuthenticatorSecret(?string $googleAuthenticatorSecret): void
    {
        $this->googleAuthenticatorSecret = $googleAuthenticatorSecret;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|UserCharCards[]
     */
    public function getUserCharCards(): Collection
    {
        return $this->userCharCards;
    }

    public function addUserCharCard(UserCharCards $userCharCard): self
    {
        if (!$this->userCharCards->contains($userCharCard)) {
            $this->userCharCards[] = $userCharCard;
            $userCharCard->setUser($this);
        }

        return $this;
    }

    public function removeUserCharCard(UserCharCards $userCharCard): self
    {
        if ($this->userCharCards->contains($userCharCard)) {
            $this->userCharCards->removeElement($userCharCard);
            // set the owning side to null (unless already changed)
            if ($userCharCard->getUser() === $this) {
                $userCharCard->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserUtilCards[]
     */
    public function getUserUtilCards(): Collection
    {
        return $this->userUtilCards;
    }

    public function addUserUtilCard(UserUtilCards $userUtilCard): self
    {
        if (!$this->userUtilCards->contains($userUtilCard)) {
            $this->userUtilCards[] = $userUtilCard;
            $userUtilCard->setUser($this);
        }

        return $this;
    }

    public function removeUserUtilCard(UserUtilCards $userUtilCard): self
    {
        if ($this->userUtilCards->contains($userUtilCard)) {
            $this->userUtilCards->removeElement($userUtilCard);
            // set the owning side to null (unless already changed)
            if ($userUtilCard->getUser() === $this) {
                $userUtilCard->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserCharDecks[]
     */
    public function getUserCharDecks(): Collection
    {
        return $this->userCharDecks;
    }

    public function addUserCharDeck(UserCharDecks $userCharDeck): self
    {
        if (!$this->userCharDecks->contains($userCharDeck)) {
            $this->userCharDecks[] = $userCharDeck;
            $userCharDeck->setUser($this);
        }

        return $this;
    }

    public function removeUserCharDeck(UserCharDecks $userCharDeck): self
    {
        if ($this->userCharDecks->contains($userCharDeck)) {
            $this->userCharDecks->removeElement($userCharDeck);
            // set the owning side to null (unless already changed)
            if ($userCharDeck->getUser() === $this) {
                $userCharDeck->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserUtilDecks[]
     */
    public function getUserUtilDecks(): Collection
    {
        return $this->userUtilDecks;
    }

    public function addUserUtilDeck(UserUtilDecks $userUtilDeck): self
    {
        if (!$this->userUtilDecks->contains($userUtilDeck)) {
            $this->userUtilDecks[] = $userUtilDeck;
            $userUtilDeck->setUser($this);
        }

        return $this;
    }

    public function removeUserUtilDeck(UserUtilDecks $userUtilDeck): self
    {
        if ($this->userUtilDecks->contains($userUtilDeck)) {
            $this->userUtilDecks->removeElement($userUtilDeck);
            // set the owning side to null (unless already changed)
            if ($userUtilDeck->getUser() === $this) {
                $userUtilDeck->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CustomCard[]
     */
    public function getCustomCards(): Collection
    {
        return $this->customCards;
    }

    public function addCustomCard(CustomCard $customCard): self
    {
        if (!$this->customCards->contains($customCard)) {
            $this->customCards[] = $customCard;
            $customCard->setUser($this);
        }

        return $this;
    }

    public function removeCustomCard(CustomCard $customCard): self
    {
        if ($this->customCards->contains($customCard)) {
            $this->customCards->removeElement($customCard);
            // set the owning side to null (unless already changed)
            if ($customCard->getUser() === $this) {
                $customCard->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserAchievement[]
     */
    public function getUserAchievements(): Collection
    {
        return $this->userAchievements;
    }

    public function addUserAchievement(UserAchievement $userAchievement): self
    {
        if (!$this->userAchievements->contains($userAchievement)) {
            $this->userAchievements[] = $userAchievement;
            $userAchievement->setUser($this);
        }

        return $this;
    }

    public function removeUserAchievement(UserAchievement $userAchievement): self
    {
        if ($this->userAchievements->contains($userAchievement)) {
            $this->userAchievements->removeElement($userAchievement);
            // set the owning side to null (unless already changed)
            if ($userAchievement->getUser() === $this) {
                $userAchievement->setUser(null);
            }
        }

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
            $battleRequestsAttacker->setAttacker($this);
        }

        return $this;
    }

    public function removeBattleRequestsAttacker(BattleRequest $battleRequestsAttacker): self
    {
        if ($this->battleRequests_attacker->contains($battleRequestsAttacker)) {
            $this->battleRequests_attacker->removeElement($battleRequestsAttacker);
            // set the owning side to null (unless already changed)
            if ($battleRequestsAttacker->getAttacker() === $this) {
                $battleRequestsAttacker->setAttacker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BattleRequest[]
     */
    public function getBattlerRequestsDefender(): Collection
    {
        return $this->battlerRequests_defender;
    }

    public function addBattlerRequestsDefender(BattleRequest $battlerRequestsDefender): self
    {
        if (!$this->battlerRequests_defender->contains($battlerRequestsDefender)) {
            $this->battlerRequests_defender[] = $battlerRequestsDefender;
            $battlerRequestsDefender->setDefender($this);
        }

        return $this;
    }

    public function removeBattlerRequestsDefender(BattleRequest $battlerRequestsDefender): self
    {
        if ($this->battlerRequests_defender->contains($battlerRequestsDefender)) {
            $this->battlerRequests_defender->removeElement($battlerRequestsDefender);
            // set the owning side to null (unless already changed)
            if ($battlerRequestsDefender->getDefender() === $this) {
                $battlerRequestsDefender->setDefender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Battle[]
     */
    public function getBattleWinner(): Collection
    {
        return $this->battle_winner;
    }

    public function addBattleWinner(Battle $battleWinner): self
    {
        if (!$this->battle_winner->contains($battleWinner)) {
            $this->battle_winner[] = $battleWinner;
            $battleWinner->setWinner($this);
        }

        return $this;
    }

    public function removeBattleWinner(Battle $battleWinner): self
    {
        if ($this->battle_winner->contains($battleWinner)) {
            $this->battle_winner->removeElement($battleWinner);
            // set the owning side to null (unless already changed)
            if ($battleWinner->getWinner() === $this) {
                $battleWinner->setWinner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserStat[]
     */
    public function getUserStats(): Collection
    {
        return $this->userStats;
    }

    public function addUserStat(UserStat $userStat): self
    {
        if (!$this->userStats->contains($userStat)) {
            $this->userStats[] = $userStat;
            $userStat->setUser($this);
        }

        return $this;
    }

    public function removeUserStat(UserStat $userStat): self
    {
        if ($this->userStats->contains($userStat)) {
            $this->userStats->removeElement($userStat);
            // set the owning side to null (unless already changed)
            if ($userStat->getUser() === $this) {
                $userStat->setUser(null);
            }
        }

        return $this;
    }

    public function getCoins(): ?int
    {
        return $this->coins;
    }

    public function setCoins(int $coins): self
    {
        $this->coins = $coins;

        return $this;
    }



}


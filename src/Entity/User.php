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
     * @ORM\OneToMany(targetEntity="App\Entity\CharDeck", mappedBy="user_id")
     */
    protected $char_deck_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCharCard", mappedBy="user_id")
     */
    protected $user_char_card_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UtilDeck", mappedBy="user_id")
     */
    protected $util_deck_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilCard", mappedBy="user_id")
     */
    protected $user_util_card_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="winner_id")
     */
    protected $battle_winner_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attacker_id")
     */
    protected $attacker_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="defender_id")
     */
    protected $defender_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="user_id")
     */
    protected $user_stat_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAchievement", mappedBy="user_id")
     */
    protected $user_achievement_users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CustomCard", mappedBy="user_id")
     */
    protected $custom_card_users;

    public function __construct()
    {
        $this->char_deck_users = new ArrayCollection();
        $this->user_char_card_users = new ArrayCollection();
        $this->util_deck_users = new ArrayCollection();
        $this->user_util_card_users = new ArrayCollection();
        $this->battle_winner_users = new ArrayCollection();
        $this->attacker_users = new ArrayCollection();
        $this->defender_users = new ArrayCollection();
        $this->user_stat_users = new ArrayCollection();
        $this->user_achievement_users = new ArrayCollection();
        $this->custom_card_users = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getCharDeckUsers()
    {
        return $this->char_deck_users;
    }

    /**
     * @return Collection
     */
    public function getBattleUsers()
    {
        return $this->battle_users;
    }

    /**
     * @return Collection
     */
    public function getAttackerUsers()
    {
        return $this->attacker_users;
    }

    /**
     * @return Collection
     */
    public function getUtilDeckUsers()
    {
        return $this->util_deck_users;
    }

    /**
     * @return Collection
     */
    public function getDefenderUsers()
    {
        return $this->defender_users;
    }

    /**
     * @return Collection
     */
    public function getCustomCardUsers()
    {
        return $this->custom_card_users;
    }

    /**
     * @return Collection
     */
    public function getUserCharCardUsers()
    {
        return $this->user_char_card_users;
    }

    /**
     * @return Collection
     */
    public function getUserUtilCardUsers()
    {
        return $this->user_util_card_users;
    }

    /**
     * @return Collection
     */
    public function getUserStatUsers()
    {
        return $this->user_stat_users;
    }

    /**
     * @return Collection
     */
    public function getUserAchievementUsers()
    {
        return $this->user_achievement_users;
    }

    /**
     * @ORM\Column(name="googleAuthenticatorSecret", type="string", nullable=true)
     */
    protected $googleAuthenticatorSecret;

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
}


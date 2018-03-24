<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
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
         * @ORM\OneToMany(targetEntity="App\Entity\UserCharCard", mappedBy="user_id")
         * @ORM\OneToMany(targetEntity="App\Entity\CustomCard", mappedBy="user_id")
         * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="user_id")
         * @ORM\OneToMany(targetEntity="App\Entity\Battle", mappedBy="winner_id")
         * @ORM\OneToMany(targetEntity="App\Entity\UtilDeck", mappedBy="user_id")
         * @ORM\OneToMany(targetEntity="App\Entity\UserUtilCard", mappedBy="user_id")
         * @ORM\OneToMany(targetEntity="App\Entity\UserAchievement", mappedBy="user_id")
         * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="attacker_id")
         * @ORM\OneToMany(targetEntity="App\Entity\BattleRequest", mappedBy="defender_id")
         */
        protected $users;

        public function __construct()
        {
            $this->users = new ArrayCollection();
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


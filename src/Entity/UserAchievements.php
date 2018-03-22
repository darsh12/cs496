<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAchievementsRepository")
 */
class UserAchievements
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="id")
     */
    private $user_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\Achievements", mappedBy="id")
     */
    private $achievement_id;

    /**
     * UserAchievements constructor.
     * @param $user_id
     * @param $achievement_id
     */
    public function __construct($user_id, $achievement_id)
    {
        $this->user_id = new ArrayCollection();
        $this->achievement_id = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getAchievementId()
    {
        return $this->achievement_id;
    }

    /**
     * @param mixed $achievement_id
     */
    public function setAchievementId($achievement_id): void
    {
        $this->achievement_id = $achievement_id;
    }
}

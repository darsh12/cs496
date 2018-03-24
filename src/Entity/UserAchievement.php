<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserAchievementRepository")
 */
class UserAchievement
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Achievement")
     * @ORM\JoinColumn(name="achievement_id", referencedColumnName="id")
     */
    protected $achievement_id;

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

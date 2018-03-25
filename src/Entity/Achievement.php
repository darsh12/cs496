<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AchievementRepository")
 */
class Achievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAchievement", mappedBy="achievement_id")
     */
    protected $achievements;

    public function __construct()
    {
        $this->achievements = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reward")
     * @ORM\JoinColumn(name="reward_id", referencedColumnName="id")
     */
    protected $reward_id;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $count_value;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRewardId()
    {
        return $this->reward_id;
    }

    /**
     * @param mixed $reward_id
     */
    public function setRewardId(Reward $reward_id): void
    {
        $this->reward_id = $reward_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCountValue()
    {
        return $this->count_value;
    }

    /**
     * @param mixed $count_value
     */
    public function setCountValue($count_value): void
    {
        $this->count_value = $count_value;
    }
}

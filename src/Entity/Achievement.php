<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AchievementRepository")
 */
class Achievement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reward", inversedBy="achievements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reward;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $count_value;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAchievement", mappedBy="achievement")
     */
    private $userAchievements;

    public function __construct()
    {
        $this->userAchievements = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getReward(): ?Reward
    {
        return $this->reward;
    }

    public function setReward(?Reward $reward): self
    {
        $this->reward = $reward;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCountValue(): ?int
    {
        return $this->count_value;
    }

    public function setCountValue(int $count_value): self
    {
        $this->count_value = $count_value;

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
            $userAchievement->setAchievement($this);
        }

        return $this;
    }

    public function removeUserAchievement(UserAchievement $userAchievement): self
    {
        if ($this->userAchievements->contains($userAchievement)) {
            $this->userAchievements->removeElement($userAchievement);
            // set the owning side to null (unless already changed)
            if ($userAchievement->getAchievement() === $this) {
                $userAchievement->setAchievement(null);
            }
        }

        return $this;
    }
}

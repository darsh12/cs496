<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilCardsRepository")
 */
class UtilCards
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilDecks", inversedBy="card1_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilDecks", inversedBy="card2_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilDecks", inversedBy="card3_id")
     * @ORM\ManyToOne(targetEntity="App\Entity\UserUtilCards", inversedBy="util_card_id")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $util_name;

    /**
     * @ORM\Column(type="string")
     */
    private $util_type;

    /**
     * @ORM\Column(type="string")
     */
    private $util_tier;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\Avatars", mappedBy="id")
     */
    private $avatar_id;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\AtkUtilEffects", mappedBy="id")
     */
    private $attack_effect_id;

    /**
     * @ORM\Column(type="integer")
     * ORM\OneToMany(targetEntity="App\Entity\DefUtilEffects", mappedBy="id")
     */
    private $defense_effect_id;

    /**
     * UtilCards constructor.
     * @param $avatar_id
     * @param $attack_effect_id
     * @param $defense_effect_id
     */
    public function __construct($avatar_id, $attack_effect_id, $defense_effect_id)
    {
        $this->avatar_id = new ArrayCollection();
        $this->attack_effect_id = new ArrayCollection();
        $this->defense_effect_id = new ArrayCollection();
    }

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
    public function getUtilName()
    {
        return $this->util_name;
    }

    /**
     * @param mixed $util_name
     */
    public function setUtilName($util_name): void
    {
        $this->util_name = $util_name;
    }

    /**
     * @return mixed
     */
    public function getUtilType()
    {
        return $this->util_type;
    }

    /**
     * @param mixed $util_type
     */
    public function setUtilType($util_type): void
    {
        $this->util_type = $util_type;
    }

    /**
     * @return mixed
     */
    public function getUtilTier()
    {
        return $this->util_tier;
    }

    /**
     * @param mixed $util_tier
     */
    public function setUtilTier($util_tier): void
    {
        $this->util_tier = $util_tier;
    }

    /**
     * @return mixed
     */
    public function getAvatarId()
    {
        return $this->avatar_id;
    }

    /**
     * @param mixed $avatar_id
     */
    public function setAvatarId($avatar_id): void
    {
        $this->avatar_id = $avatar_id;
    }

    /**
     * @return mixed
     */
    public function getAttackEffectId()
    {
        return $this->attack_effect_id;
    }

    /**
     * @param mixed $attack_effect_id
     */
    public function setAttackEffectId($attack_effect_id): void
    {
        $this->attack_effect_id = $attack_effect_id;
    }

    /**
     * @return mixed
     */
    public function getDefenseEffectId()
    {
        return $this->defense_effect_id;
    }

    /**
     * @param mixed $defense_effect_id
     */
    public function setDefenseEffectId($defense_effect_id): void
    {
        $this->defense_effect_id = $defense_effect_id;
    }
}

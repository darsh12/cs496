<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UtilCardRepository")
 */
class UtilCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UtilDeck", mappedBy="card1_id")
     * @ORM\OneToMany(targetEntity="App\Entity\UtilDeck", mappedBy="card2_id")
     * @ORM\OneToMany(targetEntity="App\Entity\UtilDeck", mappedBy="card3_id")
     * @ORM\OneToMany(targetEntity="App\Entity\UserUtilCard", mappedBy="util_card_id")
     */
    protected $util_cards;

    public function __construct()
    {
        $this->util_cards = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string")
     */
    protected $util_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $util_type;

    /**
     * @ORM\Column(type="string")
     */
    protected $util_tier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avatar", inversedBy="avatars")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     */
    protected $avatar_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AtkUtilEffect", inversedBy="atk_util_effects")
     * @ORM\JoinColumn(name="attack_effect_id", referencedColumnName="id")
     */
    protected $attack_effect_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DefUtilEffect", inversedBy="def_util_effects")
     * @ORM\JoinColumn(name="defense_effect_id", referencedColumnName="id")
     */
    protected $defense_effect_id;

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
    public function setAvatarId(Avatar $avatar_id): void
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
    public function setAttackEffectId(AtkUtilEffect $attack_effect_id): void
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
    public function setDefenseEffectId(DefUtilEffect $defense_effect_id): void
    {
        $this->defense_effect_id = $defense_effect_id;
    }
}

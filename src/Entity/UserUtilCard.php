<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserUtilCardRepository")
 */
class UserUtilCard
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
     * ORM\OneToMany(targetEntity="App\Entity\UtilCard", mappedBy="id")
     */
    private $util_card_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_count;

    /**
     * @ORM\Column(type="integer")
     */
    private $card_uses;

    /**
     * UserUtilCard constructor.
     * @param $user_id
     * @param $util_card_id
     */
    public function __construct($user_id, $util_card_id)
    {
        $this->user_id = new ArrayCollection();
        $this->util_card_id = new ArrayCollection();
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
    public function getUtilCardId()
    {
        return $this->util_card_id;
    }

    /**
     * @param mixed $util_card_id
     */
    public function setUtilCardId($util_card_id): void
    {
        $this->util_card_id = $util_card_id;
    }

    /**
     * @return mixed
     */
    public function getCardCount()
    {
        return $this->card_count;
    }

    /**
     * @param mixed $card_count
     */
    public function setCardCount($card_count): void
    {
        $this->card_count = $card_count;
    }

    /**
     * @return mixed
     */
    public function getCardUses()
    {
        return $this->card_uses;
    }

    /**
     * @param mixed $card_uses
     */
    public function setCardUses($card_uses): void
    {
        $this->card_uses = $card_uses;
    }
}

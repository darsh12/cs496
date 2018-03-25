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
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilCard")
     * @ORM\JoinColumn(name="util_card_id", referencedColumnName="id")
     */
    protected $util_card_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $card_count;

    /**
     * @ORM\Column(type="integer")
     */
    protected $card_uses;

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
    public function setUserId(User $user_id): void
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
    public function setUtilCardId(UtilCard $util_card_id): void
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

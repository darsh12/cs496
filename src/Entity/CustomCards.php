<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomCardsRepository")
 */
class CustomCards
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="id")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\CustomCardStats", mappedBy="id")
     */
    private $card_stat_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $votes;

    /**
     * CustomCards constructor.
     * @param $user_id
     * @param $card_stat_id
     */
    public function __construct($user_id, $card_stat_id)
    {
        $this->user_id = new ArrayCollection();
        $this->card_stat_id = new ArrayCollection();
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
    public function getCardStatId()
    {
        return $this->card_stat_id;
    }

    /**
     * @param mixed $card_stat_id
     */
    public function setCardStatId($card_stat_id): void
    {
        $this->card_stat_id = $card_stat_id;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
    }
}

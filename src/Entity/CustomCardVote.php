<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomCardVoteRepository")
 */
class CustomCardVote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userCustomCardVotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CustomCard", inversedBy="customCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customCard;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"Up", "Down"})
     */
    private $vote;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCustomCard()
    {
        return $this->customCard;
    }

    /**
     * @param mixed $customCard
     */
    public function setCustomCard($customCard): void
    {
        $this->customCard = $customCard;
    }

    /**
     * @return mixed
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param mixed $vote
     */
    public function setVote($vote): void
    {
        $this->vote = $vote;
    }
}

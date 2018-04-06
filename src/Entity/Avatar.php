<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 */
class Avatar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharCard", mappedBy="avatar_id")
     */
    protected $char_card_avatars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UtilCard", mappedBy="avatar_id")
     */
    protected $util_card_avatars;

    public function __construct()
    {
        $this->char_card_avatars = new ArrayCollection();
        $this->util_card_avatars = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getCharCardAvatars()
    {
        return $this->char_card_avatars;
    }

    /**
     * @return Collection
     */
    public function getUtilCardAvatars()
    {
        return $this->util_card_avatars;
    }
    /**
     * @ORM\Column(type="string")
     */
    protected $image_path;

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
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param mixed $image_path
     */
    public function setImagePath($image_path): void
    {
        $this->image_path = $image_path;
    }
}

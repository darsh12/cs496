<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AvatarRepository")
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
     * @ORM\OneToMany(targetEntity="App\Entity\UtilCard", mappedBy="avatar_id")
     */
    protected $avatars;

    public function __construct()
    {
        $this->avatars = new ArrayCollection();
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

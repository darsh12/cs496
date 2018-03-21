<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvatarsRepository")
 */
class Avatars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\CharCards", inversedBy="avatar_id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $image_path;

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

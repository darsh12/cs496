<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestTableRepository")
 */
class TestTable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $card_hp;

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
    public function getCardHp()
    {
        return $this->card_hp;
    }

    /**
     * @param mixed $card_hp
     */
    public function setCardHp($card_hp): void
    {
        $this->card_hp = $card_hp;
    }

    /**
     * @return mixed
     */
    public function getCardImage()
    {
        return $this->card_image;
    }

    /**
     * @param mixed $card_image
     */
    public function setCardImage($card_image): void
    {
        $this->card_image = $card_image;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $card_image;


}

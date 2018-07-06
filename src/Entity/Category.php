<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $slug;

    /** @ORM\Column(type="array")  */
    private $childrens;

    public function __construct()
    {
        $childrens = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param mixed $string
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @param mixed $childrens
     */
    public function setChildrens(Category $child): void
    {
        $this->childrens[] = $child;
    }

    public function getChildrens()
    {
        return $this->childrens;
    }
}

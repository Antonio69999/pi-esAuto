<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;


    #[ORM\ManyToOne(inversedBy: 'promotions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $misAJourLe = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creeLe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get the value of misAJourLe
     */
    public function getMisAJourLe()
    {
        return $this->misAJourLe;
    }

    /**
     * Set the value of misAJourLe
     *
     * @return  self
     */
    public function setMisAJourLe($misAJourLe)
    {
        $this->misAJourLe = $misAJourLe;

        return $this;
    }

    /**
     * Get the value of creeLe
     */
    public function getCreeLe()
    {
        return $this->creeLe;
    }

    /**
     * Set the value of creeLe
     *
     * @return  self
     */
    public function setCreeLe($creeLe)
    {
        $this->creeLe = $creeLe;

        return $this;
    }
}

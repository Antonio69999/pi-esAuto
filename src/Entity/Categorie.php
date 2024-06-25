<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $misAJourLe = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creeLE = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Produit::class)]
    private Collection $produits;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Promotion::class)]
    private Collection $promotions;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

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
     * Get the value of creeLE
     */
    public function getCreeLE()
    {
        return $this->creeLE;
    }

    /**
     * Set the value of creeLE
     *
     * @return  self
     */
    public function setCreeLE($creeLE)
    {
        $this->creeLE = $creeLE;

        return $this;
    }

    /**
     * Get the value of produits
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Set the value of produits
     *
     * @return  self
     */
    public function setProduits($produits)
    {
        $this->produits = $produits;

        return $this;
    }

    /**
     * Get the value of promotions
     */
    public function getPromotions()
    {
        return $this->promotions;
    }

    /**
     * Set the value of promotions
     *
     * @return  self
     */
    public function setPromotions($promotions)
    {
        $this->promotions = $promotions;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}

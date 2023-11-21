<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $resume = null;

    #[ORM\Column]
    private ?int $isbn = null;

    #[ORM\Column]
    private ?int $idauteur = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Auteur", inversedBy: "livres")]
    #[ORM\JoinColumn(name: "idauteur", referencedColumnName: "id")]
    private ?Auteur $auteur;

    #[ORM\ManyToMany(targetEntity: "App\Entity\Genre", inversedBy: "livres")]
    #[ORM\JoinTable(name: "appartenir")]
    #[ORM\JoinColumn(name: "idlivre", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "idgenre", referencedColumnName: "id")]
    private ?Collection $genres = null;


    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function setIsbn(int $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getIdauteur(): ?int
    {
        return $this->idauteur;
    }

    public function setIdauteur(int $idauteur): static
    {
        $this->idauteur = $idauteur;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $genre->addLivre($this);
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }
}

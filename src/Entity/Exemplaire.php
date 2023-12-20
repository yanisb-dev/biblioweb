<?php

namespace App\Entity;

use App\Repository\ExemplaireRepository;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExemplaireRepository::class)]
class Exemplaire
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $numero = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Livre')]
    #[ORM\JoinColumn(name: 'idlivre', referencedColumnName: 'id')]
    private ?Livre $livre;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateretour = null;

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getLivre(): ?string
    {
        return $this->livre;
    }

    public function setLivre(?string $livre): static
    {
        $this->livre = $livre;

        return $this;
    }

    public function getDateretour(): ?string
    {
        return $this->dateretour;
    }

    public function setDateretour(?string $dateretour): static
    {
        $this->dateretour = $dateretour;

        return $this;
    }
}

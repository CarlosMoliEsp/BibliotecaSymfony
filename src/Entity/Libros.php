<?php

namespace App\Entity;

use App\Repository\LibrosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibrosRepository::class)]
class Libros
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $editorial = null;

    #[ORM\Column(length: 255)]
    private ?string $autor = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $n_edicion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_edicion = null;

    #[ORM\OneToMany(mappedBy: 'id_libro', targetEntity: Ejemplares::class)]
    private Collection $ejemplares;

    public function __construct()
    {
        $this->ejemplares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getNEdicion(): ?string
    {
        return $this->n_edicion;
    }

    public function setNEdicion(string $n_edicion): self
    {
        $this->n_edicion = $n_edicion;

        return $this;
    }

    public function getFechaEdicion(): ?\DateTimeInterface
    {
        return $this->fecha_edicion;
    }

    public function setFechaEdicion(\DateTimeInterface $fecha_edicion): self
    {
        $this->fecha_edicion = $fecha_edicion;

        return $this;
    }

    /**
     * @return Collection<int, Ejemplares>
     */
    public function getEjemplares(): Collection
    {
        return $this->ejemplares;
    }

    public function addEjemplare(Ejemplares $ejemplare): self
    {
        if (!$this->ejemplares->contains($ejemplare)) {
            $this->ejemplares->add($ejemplare);
            $ejemplare->setIdLibro($this);
        }

        return $this;
    }

    public function removeEjemplare(Ejemplares $ejemplare): self
    {
        if ($this->ejemplares->removeElement($ejemplare)) {
            // set the owning side to null (unless already changed)
            if ($ejemplare->getIdLibro() === $this) {
                $ejemplare->setIdLibro(null);
            }
        }

        return $this;
    }
}

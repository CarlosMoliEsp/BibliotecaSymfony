<?php

namespace App\Entity;

use App\Repository\EjemplaresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EjemplaresRepository::class)]
class Ejemplares
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $codigo = null;

    #[ORM\ManyToOne(inversedBy: 'ejemplares')]
    private ?Libros $id_libro = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\OneToMany(mappedBy: 'id_ejemplares', targetEntity: Presta::class)]
    private Collection $prestas;

    public function __construct()
    {
        $this->prestas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getIdLibro(): ?Libros
    {
        return $this->id_libro;
    }

    public function setIdLibro(?Libros $id_libro): self
    {
        $this->id_libro = $id_libro;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection<int, Presta>
     */
    public function getPrestas(): Collection
    {
        return $this->prestas;
    }

    public function addPresta(Presta $presta): self
    {
        if (!$this->prestas->contains($presta)) {
            $this->prestas->add($presta);
            $presta->setIdEjemplares($this);
        }

        return $this;
    }

    public function removePresta(Presta $presta): self
    {
        if ($this->prestas->removeElement($presta)) {
            // set the owning side to null (unless already changed)
            if ($presta->getIdEjemplares() === $this) {
                $presta->setIdEjemplares(null);
            }
        }

        return $this;
    }
}

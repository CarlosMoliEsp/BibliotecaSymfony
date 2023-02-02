<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
class Socio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido1 = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido2 = null;

    #[ORM\Column(length: 255)]
    private ?string $telefono = null;

    #[ORM\Column(length: 255)]
    private ?string $n_socio = null;

    #[ORM\OneToMany(mappedBy: 'id_socio', targetEntity: Presta::class)]
    private Collection $prestas;

    public function __construct()
    {
        $this->prestas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): self
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(string $apellido2): self
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getNSocio(): ?string
    {
        return $this->n_socio;
    }

    public function setNSocio(string $n_socio): self
    {
        $this->n_socio = $n_socio;

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
            $presta->setIdSocio($this);
        }

        return $this;
    }

    public function removePresta(Presta $presta): self
    {
        if ($this->prestas->removeElement($presta)) {
            // set the owning side to null (unless already changed)
            if ($presta->getIdSocio() === $this) {
                $presta->setIdSocio(null);
            }
        }

        return $this;
    }
}

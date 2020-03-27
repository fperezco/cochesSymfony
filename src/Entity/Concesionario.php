<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConcesionarioRepository")
 */
class Concesionario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coche", mappedBy="concesionario")
     */
    private $coches;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * @return Collection|Coche[]
     */
    public function getCoches(): Collection
    {
        return $this->coches;
    }

    public function addCoch(Coche $coch): self
    {
        if (!$this->coches->contains($coch)) {
            $this->coches[] = $coch;
            $coch->setConcesionario($this);
        }

        return $this;
    }

    public function removeCoch(Coche $coch): self
    {
        if ($this->coches->contains($coch)) {
            $this->coches->removeElement($coch);
            // set the owning side to null (unless already changed)
            if ($coch->getConcesionario() === $this) {
                $coch->setConcesionario(null);
            }
        }

        return $this;
    }
}

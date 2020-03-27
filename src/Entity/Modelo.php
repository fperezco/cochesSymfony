<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeloRepository")
 */
class Modelo
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
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coche", mappedBy="modelo")
     */
    private $coches;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marca", inversedBy="modelos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marca;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $coch->setModelo($this);
        }

        return $this;
    }

    public function removeCoch(Coche $coch): self
    {
        if ($this->coches->contains($coch)) {
            $this->coches->removeElement($coch);
            // set the owning side to null (unless already changed)
            if ($coch->getModelo() === $this) {
                $coch->setModelo(null);
            }
        }

        return $this;
    }

    public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;

        return $this;
    }
}

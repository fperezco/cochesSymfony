<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MarcaRepository")
 */
class Marca
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotEqualTo("fail", message="No puede ser igual a fail")
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coche", mappedBy="marca")
     */
    private $coches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Modelo", mappedBy="marca")
     */
    private $modelos;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
        $this->modelos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return $this
     * @throws Exception
     *
     */
    public function setNombre(string $nombre): self
    {
        //if ($nombre =="fail")
        //    throw new Exception("nombre no puede ser fail");
        //else{
            $this->nombre = $nombre;
            return $this;
        //}
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
            $coch->setMarca($this);
        }

        return $this;
    }

    public function removeCoch(Coche $coch): self
    {
        if ($this->coches->contains($coch)) {
            $this->coches->removeElement($coch);
            // set the owning side to null (unless already changed)
            if ($coch->getMarca() === $this) {
                $coch->setMarca(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Modelo[]
     */
    public function getModelos(): Collection
    {
        return $this->modelos;
    }

    public function addModelo(Modelo $modelo): self
    {
        if (!$this->modelos->contains($modelo)) {
            $this->modelos[] = $modelo;
            $modelo->setMarca($this);
        }

        return $this;
    }

    public function removeModelo(Modelo $modelo): self
    {
        if ($this->modelos->contains($modelo)) {
            $this->modelos->removeElement($modelo);
            // set the owning side to null (unless already changed)
            if ($modelo->getMarca() === $this) {
                $modelo->setMarca(null);
            }
        }

        return $this;
    }
}

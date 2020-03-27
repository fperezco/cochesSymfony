<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use PHPUnit\Runner\Exception;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CocheRepository")
 */
class Coche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\Column(type="date")
     */
    private $anyo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricula;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vendido;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modelo", inversedBy="coches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modelo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marca", inversedBy="coches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marca;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Concesionario", inversedBy="coches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concesionario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        if ($precio > 10000) {
            throw  new Exception("precio invalido superior a 10.000");
        }
        $this->precio = $precio;

        return $this;
    }

    public function getAnyo(): ?\DateTimeInterface
    {
        return $this->anyo;
    }

    public function setAnyo(\DateTimeInterface $anyo): self
    {
        $this->anyo = $anyo;

        return $this;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getVendido(): ?bool
    {
        return $this->vendido;
    }

    public function setVendido(bool $vendido): self
    {
        $this->vendido = $vendido;

        return $this;
    }

    public function getModelo(): ?Modelo
    {
        return $this->modelo;
    }

    public function setModelo(?Modelo $modelo): self
    {
        $this->modelo = $modelo;

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

    public function getConcesionario(): ?Concesionario
    {
        return $this->concesionario;
    }

    public function setConcesionario(?Concesionario $concesionario): self
    {
        $this->concesionario = $concesionario;

        return $this;
    }
}

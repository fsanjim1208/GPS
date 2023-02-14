<?php

namespace App\Entity;

use App\Repository\BandaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandaRepository::class)]
class Banda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $frecuencia_min = null;

    #[ORM\Column]
    private ?int $frecuencia_max = null;

    #[ORM\Column]
    private ?int $distancia = null;

    #[ORM\OneToMany(mappedBy: 'id_banda', targetEntity: Mensaje::class)]
    private Collection $mensajes;

    public function __construct()
    {
        $this->mensajes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrecuenciaMin(): ?int
    {
        return $this->frecuencia_min;
    }

    public function setFrecuenciaMin(int $frecuencia_min): self
    {
        $this->frecuencia_min = $frecuencia_min;

        return $this;
    }

    public function getFrecuenciaMax(): ?int
    {
        return $this->frecuencia_max;
    }

    public function setFrecuenciaMax(int $frecuencia_max): self
    {
        $this->frecuencia_max = $frecuencia_max;

        return $this;
    }

    public function getDistancia(): ?int
    {
        return $this->distancia;
    }

    public function setDistancia(int $distancia): self
    {
        $this->distancia = $distancia;

        return $this;
    }

    /**
     * @return Collection<int, Mensaje>
     */
    public function getMensajes(): Collection
    {
        return $this->mensajes;
    }

    public function addMensaje(Mensaje $mensaje): self
    {
        if (!$this->mensajes->contains($mensaje)) {
            $this->mensajes->add($mensaje);
            $mensaje->setIdBanda($this);
        }

        return $this;
    }

    public function removeMensaje(Mensaje $mensaje): self
    {
        if ($this->mensajes->removeElement($mensaje)) {
            // set the owning side to null (unless already changed)
            if ($mensaje->getIdBanda() === $this) {
                $mensaje->setIdBanda(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
    return $this->getDistancia().': ('.$this->getFrecuenciaMin().' - '.$this->getFrecuenciaMax().')';
    }
}

<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_participante = null;

    #[ORM\Column]
    private ?int $id_juez = null;

    #[ORM\Column]
    private ?int $id_modo = null;

    #[ORM\Column]
    private ?int $id_banda = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(nullable: true)]
    private ?bool $validado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdParticipante(): ?int
    {
        return $this->id_participante;
    }

    public function setIdParticipante(int $id_participante): self
    {
        $this->id_participante = $id_participante;

        return $this;
    }

    public function getIdJuez(): ?int
    {
        return $this->id_juez;
    }

    public function setIdJuez(int $id_juez): self
    {
        $this->id_juez = $id_juez;

        return $this;
    }

    public function getIdModo(): ?int
    {
        return $this->id_modo;
    }

    public function setIdModo(int $id_modo): self
    {
        $this->id_modo = $id_modo;

        return $this;
    }

    public function getIdBanda(): ?int
    {
        return $this->id_banda;
    }

    public function setIdBanda(int $id_banda): self
    {
        $this->id_banda = $id_banda;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function isValidado(): ?bool
    {
        return $this->validado;
    }

    public function setValidado(?bool $validado): self
    {
        $this->validado = $validado;

        return $this;
    }
}

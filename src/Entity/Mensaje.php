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
    private ?String $fecha = null;

    #[ORM\Column(nullable: true)]
    private ?bool $validado = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modo $id_modo = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Banda $id_banda = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $participante = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $juez = null;

    #[ORM\Column]
    private ?int $distancia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?String
    {
        return $this->fecha;
    }

    public function setFecha(String $fecha): self
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

    public function getIdModo(): ?modo
    {
        return $this->id_modo;
    }

    public function setIdModo(?modo $id_modo): self
    {
        $this->id_modo = $id_modo;

        return $this;
    }

    public function getIdBanda(): ?banda
    {
        return $this->id_banda;
    }

    public function setIdBanda(?banda $id_banda): self
    {
        $this->id_banda = $id_banda;

        return $this;
    }

    public function getParticipante(): ?user
    {
        return $this->participante;
    }

    public function setParticipante(?user $participante): self
    {
        $this->participante = $participante;

        return $this;
    }

    public function getJuez(): ?user
    {
        return $this->juez;
    }

    public function setJuez(?user $juez): self
    {
        $this->juez = $juez;

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
}

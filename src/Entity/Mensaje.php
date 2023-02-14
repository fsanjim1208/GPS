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



    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(nullable: true)]
    private ?bool $validado = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?modo $id_modo = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?banda $id_banda = null;

    public function getId(): ?int
    {
        return $this->id;
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
}

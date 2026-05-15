<?php

namespace App\Domain;

class AnimalSinPeso implements AnimalIdentificable
{
    public function __construct(
        private string $nombre,
        private string $numeroArete,
        private int    $razaId,
        private int    $ranchoId,
        private \DateTimeInterface $fechaNacimiento,
    ) {}

    public function getNombre(): string      { return $this->nombre; }
    public function getNumeroArete(): string { return $this->numeroArete; }
    public function getRazaId(): int         { return $this->razaId; }
    public function getRanchoId(): int       { return $this->ranchoId; }

    public function calcularEdadEnMeses(): int
    {
        return (int) (new \DateTime())->diff($this->fechaNacimiento)->m
            + ((int) (new \DateTime())->diff($this->fechaNacimiento)->y * 12);
    }
}
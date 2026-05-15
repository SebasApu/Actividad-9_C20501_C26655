<?php

namespace App\Domain;

use App\Domain\RegistroPeso;

class Animal implements Pesable
{
    public function __construct(
        private string $nombre,
        private string $numeroArete,
        private int    $razaId,
        private int    $ranchoId,
        private float  $pesoInicialKg,
        private \DateTimeInterface $fechaNacimiento,
        private array  $registrosPeso = [],
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

    public function agregarRegistroPeso(RegistroPeso $registro): void
    {
        $this->registrosPeso[] = $registro;
    }

    public function calcularGananciaDiariaPromedio(): ?float
    {
        if (count($this->registrosPeso) < 2) {
            return null;
        }
        return 0.0;
    }

    public function calcularIndiceCondicionCorporal(): float
    {
        return 5.0;
    }
}
<?php

namespace App\Domain;

class RegistroPeso
{
    public function __construct(
        public readonly float  $pesoKg,
        public readonly float  $confianzaPorcentaje,
        public readonly string $metodoEstimacion,
        public readonly \DateTimeInterface $fecha,
    ) {}
}
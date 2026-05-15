<?php

namespace App\Contracts;

interface IEstimadorML
{
    public function estimar(array $urlsFotos, string $razaNombre, int $edadMeses): array;
}
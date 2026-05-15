<?php

namespace App\Domain;

use App\Domain\RegistroPeso;

interface Pesable extends AnimalIdentificable
{
    public function agregarRegistroPeso(RegistroPeso $registro): void;
    public function calcularGananciaDiariaPromedio(): ?float;
    public function calcularIndiceCondicionCorporal(): float;
}
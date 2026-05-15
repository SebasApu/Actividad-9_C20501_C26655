<?php

namespace App\Domain;

interface AnimalIdentificable
{
    public function getNombre(): string;
    public function getNumeroArete(): string;
    public function getRazaId(): int;
    public function getRanchoId(): int;
    public function calcularEdadEnMeses(): int;
}
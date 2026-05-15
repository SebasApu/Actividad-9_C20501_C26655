<?php

namespace App\Services;

use App\Contracts\IAnimalReader;
use App\Domain\Animal;

class ReportadorSoloLectura implements IAnimalReader
{
    public function buscarPorArete(string $arete): ?Animal
    {
        return null;
    }

    public function listarPorRancho(int $ranchoId): array
    {
        return [];
    }

    public function obtenerHistorialPeso(int $animalId): array
    {
        return [];
    }

    public function calcularEstadisticasRancho(int $ranchoId): array
    {
        return [];
    }
}
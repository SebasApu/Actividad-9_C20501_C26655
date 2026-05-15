<?php

namespace App\Services;

use App\Contracts\IAnimalGestor;
use App\Domain\Animal;
use App\Domain\RegistroPeso;

class GestorAnimalCompleto implements IAnimalGestor
{
    public function crear(array $datos): Animal
    {
        return new Animal(
            $datos['nombre'],
            $datos['numero_arete'],
            $datos['raza_id'],
            $datos['rancho_id'],
            $datos['peso_inicial_kg'],
            new \DateTime($datos['fecha_nacimiento']),
        );
    }

    public function actualizar(int $id, array $datos): Animal
    {
        return new Animal(
            $datos['nombre'],
            $datos['numero_arete'],
            $datos['raza_id'],
            $datos['rancho_id'],
            $datos['peso_inicial_kg'],
            new \DateTime($datos['fecha_nacimiento']),
        );
    }

    public function eliminar(int $id): void {}

    public function agregarRegistroPeso(int $animalId, RegistroPeso $registro): void {}

    public function asignarFotografia(int $registroId, string $urlFoto): void {}

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
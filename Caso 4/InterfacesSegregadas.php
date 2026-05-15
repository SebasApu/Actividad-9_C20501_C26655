<?php

namespace App\Contracts;

use App\Domain\Animal;
use App\Domain\RegistroPeso;

interface IAnimalWriter
{
    public function crear(array $datos): Animal;
    public function actualizar(int $id, array $datos): Animal;
    public function eliminar(int $id): void;
    public function agregarRegistroPeso(int $animalId, RegistroPeso $registro): void;
    public function asignarFotografia(int $registroId, string $urlFoto): void;
}

interface IAnimalReader
{
    public function buscarPorArete(string $arete): ?Animal;
    public function listarPorRancho(int $ranchoId): array;
    public function obtenerHistorialPeso(int $animalId): array;
    public function calcularEstadisticasRancho(int $ranchoId): array;
}

interface IAnimalGestor extends IAnimalWriter, IAnimalReader {}
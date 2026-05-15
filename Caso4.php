<?php

namespace App\Contracts;

use App\Domain\Animal;
use App\Domain\RegistroPeso;

interface IGestionAnimal
{
    public function crear(array $datos): Animal;
    public function actualizar(int $id, array $datos): Animal;
    public function eliminar(int $id): void;
    public function agregarRegistroPeso(int $animalId, RegistroPeso $registro): void;
    public function asignarFotografia(int $registroId, string $urlFoto): void;
}

interface IReportesConsultaAnimal
{
    public function buscarPorArete(string $arete): ?Animal;
    public function listarPorRancho(int $ranchoId): array;
    public function obtenerHistorialPeso(int $animalId): array;
    public function calcularEstadisticasRancho(int $ranchoId): array;
}

class ReportadorSoloLectura implements IReportesConsultaAnimal
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
/*
Caso 4: ISP: ReportadorSoloLectura implementa una interfaz que incluye operaciones de escritura que nunca 
usará. Cada vez que se añade un método a IGestorAnimal (crear, actualizar, eliminar) se rompe la 
implementación de ReportadorSoloLectura, que debe agregar un stub vacío o lanzar 
UnsupportedOperation. 

Solo se se dividió la interfaz grande en varias para que cada clase use solo los métodos que necesita
*/
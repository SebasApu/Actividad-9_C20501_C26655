<?php

namespace App\Services;

use App\Contracts\IEstimadorML;
use App\Models\Animal;
use App\Models\RegistroPeso;

class EstimadorPesoService
{
    public function __construct(
        private IEstimadorML $estimadorML,
    ) {}

    public function estimar(int $animalId, array $urlsFotos): RegistroPeso
    {
        if (empty($urlsFotos)) {
            throw new \InvalidArgumentException('Se requiere al menos una fotografía.');
        }

        if (count($urlsFotos) > 5) {
            throw new \InvalidArgumentException('Máximo 5 fotografías por sesión.');
        }

        $animal = Animal::findOrFail($animalId);

        $datos = $this->estimadorML->estimar(
            $urlsFotos,
            $animal->raza->nombre,
            $animal->calcularEdadEnMeses(),
        );

        return RegistroPeso::create([
            'animal_id'            => $animalId,
            'peso_kg'              => $datos['estimated_weight_kg'],
            'confianza_porcentaje' => $datos['confidence'] * 100,
            'metodo_estimacion'    => 'yolov8',
            'fecha'                => now(),
        ]);
    }
}
<?php

namespace App\Services;

use App\Models\Animal;
use App\Models\RegistroPeso;

interface EstimacionPesoAnimal
{
    public function estimar(array $datos);
}

class ServicioML implements EstimacionPesoAnimal
{
    public function estimar(array $datos)
    {
        return [
            'estimated_weight_kg' => 450,
            'confidence' => 0.95
        ];
    }
}

class EstimadorPesoService
{
    private EstimacionPesoAnimal $servicioML;

    public function __construct(EstimacionPesoAnimal $servicioML)
    {
        $this->servicioML = $servicioML;
    }

    public function estimar(int $animalId, array $urlsFotos): RegistroPeso
    {
        if (empty($urlsFotos)) {
            throw new \InvalidArgumentException(
                'Se requiere al menos una fotografía.'
            );
        }

        if (count($urlsFotos) > 5) {
            throw new \InvalidArgumentException(
                'Máximo 5 fotografías por sesión.'
            );
        }

        $animal = Animal::findOrFail($animalId);

        $datos = $this->servicioML->estimar([
            'image_urls' => $urlsFotos,
            'breed' => $animal->raza->nombre,
            'age_months' => $animal->calcularEdadEnMeses(),
        ]);

        $registro = RegistroPeso::create([
            'animal_id' => $animalId,
            'peso_kg' => $datos['estimated_weight_kg'],
            'confianza_porcentaje'=> $datos['confidence'] * 100,
            'metodo_estimacion' => 'yolov8',
            'fecha' => now(),
        ]);

        return $registro;
    }
}

/*
Caso 5: DIP: Es imposible probar EstimadorPesoService con una prueba unitaria sin levantar el servidor 
Python/Flask real. Cambiar el microservicio ML (de Flask a FastAPI, o de HTTP a gRPC) obliga a 
modificar la lógica de negocio. El servicio de alto nivel conoce detalles de infraestructura. 

Lo que se hizo fue básicamente crear una interfaz, quitar la dependencia directa con HTTP y Flask y  agregaer una abstracción a EstimadorPesoService

*/
<?php

namespace App\Services;

use App\Models\Animal;

class AnimalService
{
    private AnimalNotificacionService $notificador;
    private AnimalPdfService $pdfService;

    public function __construct(
        AnimalNotificacionService $notificador,
        AnimalPdfService $pdfService
    ) {
        $this->notificador = $notificador;
        $this->pdfService  = $pdfService;
    }

  
    public function registrar(array $datos): Animal
    {
        // ── Validación (lógica de negocio) ─────────────
        if (empty($datos['numero_arete'])) {
            throw new \InvalidArgumentException('El arete es obligatorio.');
        }

        if ($datos['peso_inicial_kg'] <= 0) {
            throw new \InvalidArgumentException('El peso inicial debe ser positivo.');
        }

      
        $animal = Animal::create([
            'numero_arete'    => $datos['numero_arete'],
            'nombre'          => $datos['nombre'],
            'raza_id'         => $datos['raza_id'],
            'rancho_id'       => $datos['rancho_id'],
            'peso_inicial_kg' => $datos['peso_inicial_kg'],
            'fecha_nacimiento'=> $datos['fecha_nacimiento'],
        ]);

       
        $this->notificador->notificarRegistro($animal, $datos['rancho_id']);
        $this->pdfService->generarPdfRegistro($animal, $datos['rancho_id']);

        return $animal;
    }
}
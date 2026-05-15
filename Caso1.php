<?php

namespace App\Services;

use App\Models\Animal;


class AnimalService
{
    private $notificacionService;
    private $pdfService;

    public function __construct()
    {
        $this->notificacionService = new NotificacionAnimalService();
        $this->pdfService = new PdfAnimalService();
    }

    public function registrar(array $datos): Animal
    {
        // ── Lógica de negocio ─────────────────────────
        if (empty($datos['numero_arete'])) {
            throw new \InvalidArgumentException('El arete es obligatorio.');
        }

        if ($datos['peso_inicial_kg'] <= 0) {
            throw new \InvalidArgumentException(
                'El peso inicial debe ser positivo.'
            );
        }

        $animal = Animal::create([
            'numero_arete'    => $datos['numero_arete'],
            'nombre'          => $datos['nombre'],
            'raza_id'         => $datos['raza_id'],
            'rancho_id'       => $datos['rancho_id'],
            'peso_inicial_kg' => $datos['peso_inicial_kg'],
            'fecha_nacimiento'=> $datos['fecha_nacimiento'],
        ]);

        $this->notificacionService->enviar($animal, $datos['rancho_id']);

        $this->pdfService->generar($animal);

        return $animal;
    }
}

class NotificacionAnimalService
{
    public function enviar($animal, $ranchoId)
    {
    }
}

class PdfAnimalService
{
    public function generar($animal)
    {
    }
}

/*
Caso 1: SRP: Cambiar la plantilla HTML del reporte PDF rompe los tests de la lógica de pesaje. Cambiar la librería 
de email invalida el servicio de negocio. Imposible hacer mocking de persistencia sin traer toda la 
lógica de notificación. 

Se separó notificación y pdf, también con correo y se asignó solo una responsabilidad a cada clase
*/
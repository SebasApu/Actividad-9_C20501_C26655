<?php
// ✅ CORRECCIÓN SRP — Responsabilidad: generación de PDF del registro
// Archivo: app/Services/AnimalPdfService.php

namespace App\Services;

use App\Models\Animal;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AnimalPdfService
{
    /**
     * Genera y almacena el PDF del registro de un animal.
     */
    public function generarPdfRegistro(Animal $animal, int $ranchoId): string
    {
        $propietario = DB::table('propietarios')
            ->where('rancho_id', $ranchoId)->first();

        $pdf = Pdf::loadView('reportes.registro_animal', [
            'animal'      => $animal,
            'propietario' => $propietario,
            'fecha'       => now()->format('d/m/Y H:i'),
        ]);

        $rutaPdf = 'registros/' . $animal->numero_arete . '_' . now()->timestamp . '.pdf';
        $pdf->save(storage_path('app/public/' . $rutaPdf));

        $animal->update(['ruta_pdf_registro' => $rutaPdf]);

        return $rutaPdf;
    }
}
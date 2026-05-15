<?php
// ✅ CORRECCIÓN OCP — ReporteService ahora está CERRADO para modificación
// Archivo: app/Services/ReporteService.php
//
// Para agregar un nuevo tipo de reporte (ej: 'resumen_mensual'):
//   1. Crear clase ReporteResumenMensual implements GeneradorReporte
//   2. Registrar en el mapa del ServiceProvider
//   3. NO se toca esta clase.

namespace App\Services;

use App\Contracts\GeneradorReporte;

class ReporteService
{
    /**
     * Mapa de tipo => generador, inyectado por el contenedor de Laravel.
     * @var array<string, GeneradorReporte>
     */
    private array $generadores;

    public function __construct(array $generadores)
    {
        $this->generadores = $generadores;
    }

    /**
     * Genera el reporte solicitado delegando al generador correspondiente.
     * Agregar un nuevo tipo NO requiere modificar este método.
     */
    public function generar(string $tipo, int $ranchoId): array
    {
        if (!isset($this->generadores[$tipo])) {
            throw new \InvalidArgumentException("Tipo de reporte desconocido: {$tipo}");
        }

        return $this->generadores[$tipo]->generar($ranchoId);
    }
}

// ── Registro en AppServiceProvider (o un ServiceProvider dedicado): ──
//
// $this->app->bind(ReporteService::class, function ($app) {
//     return new ReporteService([
//         'progreso_peso'      => new ReporteProgresoPeso(),
//         'condicion_corporal' => new ReporteCondicionCorporal(),
//         'inventario'         => new ReporteInventario(),
//         // Agregar nuevos tipos aquí sin tocar ReporteService:
//         // 'resumen_mensual' => new ReporteResumenMensual(),
//     ]);
// });
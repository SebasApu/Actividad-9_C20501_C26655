<?php


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

   
    public function generar(string $tipo, int $ranchoId): array
    {
        if (!isset($this->generadores[$tipo])) {
            throw new \InvalidArgumentException("Tipo de reporte desconocido: {$tipo}");
        }

        return $this->generadores[$tipo]->generar($ranchoId);
    }
}

<?php

namespace App\Services;

use App\Models\Animal;


interface Reporte
{
    public function generar(int $ranchoId): array;
}

class ReporteProgresoPeso implements Reporte
{
    public function generar(int $ranchoId): array
    {
        return [];
    }
}

class ReporteCondicionCorporal implements Reporte
{
    public function generar(int $ranchoId): array
    {
        return [];
    }
}

class ReporteInventario implements Reporte
{
    public function generar(int $ranchoId): array
    {
        return [];
    }
}

class ReporteService
{
    private Reporte $reporte;

    public function __construct(Reporte $reporte)
    {
        $this->reporte = $reporte;
    }

    public function generar(int $ranchoId): array
    {
        return $this->reporte->generar($ranchoId);
    }
}

/*
Caso 5: OCP: Cada nueva categoría de reporte (ResumenMensual, ReporteVeterinario, ReporteExportacion) 
obliga a abrir y modificar esta clase, violando el cierre. Un bug introducido al agregar el nuevo caso 
puede romper los tipos ya existentes. Los tests existentes quedan frágiles

Solo se quitó el switch, se creó una interfaz para reportes y que cada reporte tenga su clase
*/
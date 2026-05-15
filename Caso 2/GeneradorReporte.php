<?php
// ✅ CORRECCIÓN OCP — Interfaz que define el contrato de cada reporte
// Archivo: app/Contracts/GeneradorReporte.php

namespace App\Contracts;

interface GeneradorReporte
{
    /**
     * Genera los datos del reporte para un rancho dado.
     */
    public function generar(int $ranchoId): array;
}
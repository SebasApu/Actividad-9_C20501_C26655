<?php

namespace App\Contracts;

interface GeneradorReporte
{
    
    public function generar(int $ranchoId): array;
}
<?php

namespace App\Infrastructure;

use App\Contracts\IEstimadorML;
use Illuminate\Support\Facades\Http;

class EstimadorMlHttp implements IEstimadorML
{
    public function __construct(
        private string $baseUrl,
        private int    $timeoutSeconds = 30,
    ) {}

    public function estimar(array $urlsFotos, string $razaNombre, int $edadMeses): array
    {
        $respuesta = Http::timeout($this->timeoutSeconds)
            ->post($this->baseUrl . '/estimate', [
                'image_urls' => $urlsFotos,
                'breed'      => $razaNombre,
                'age_months' => $edadMeses,
            ]);

        if (!$respuesta->successful()) {
            throw new \RuntimeException('El servicio de estimación ML no respondió correctamente.');
        }

        return $respuesta->json();
    }
}
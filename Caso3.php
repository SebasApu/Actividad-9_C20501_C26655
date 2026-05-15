<?php

namespace App\Domain;

use App\Domain\RegistroPeso;

class AnimalSinPeso extends Animal
{
    public function agregarRegistroPeso(RegistroPeso $registro): void
    {
        parent::agregarRegistroPeso($registro);
    }

    public function calcularGananciaDiariaPromedio(): ?float
    {
        return parent::calcularGananciaDiariaPromedio();
    }

    public function calcularIndiceCondicionCorporal(): float
    {
        return parent::calcularIndiceCondicionCorporal();
    }
}

/*
Caso 3: LSP: Cualquier código que use la referencia Animal y llame agregarRegistroPeso() recibirá una excepción 
en tiempo de ejecución cuando el objeto sea AnimalSinPeso. Los tests pasan con Animal pero fallan 
con AnimalSinPeso. Se necesita instanceof para saber qué se puede llamar. 

básicamente se quitó la excepción que rompía el comportamiento de la clase padre y se dejó el mismo contrato de Animal
*/
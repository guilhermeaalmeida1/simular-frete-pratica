<?php

namespace src\Frete\Service\Correios;

class ShippingStrategy
{

    public string $cep;

    public function __construct(private ShippingInterface $typeOfShipping)
    {
        $this->typeOfShipping = $typeOfShipping;
    }

    public function calculaFrete()
    {
        $this->typeOfShipping->calculaFrete();
        return 1;
    }
}
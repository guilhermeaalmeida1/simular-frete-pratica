<?php

namespace src\Frete\Service\Shipping;

class ShippingStrategy
{

    public string $cep;

    public function __construct(private ShippingInterface $typeOfShipping)
    {
        $this->typeOfShipping = $typeOfShipping;
    }

    public function calculaFrete()
    {
        return $this->typeOfShipping->calculaFrete();
    }
}
<?php

namespace src\Frete\Service\Shipping;

class Correios implements ShippingInterface
{
    private $cep;
    private $peso = 1;

    public function calculaFrete()
    {
        if ($this->consultCep()){
            return $this->shippingCorreios();
        }

        return 1;
    }

    public function shippingCorreios()
    {
        return 2 + $this->peso;
    }

    public function consultCep()
    {
        return true;
    }

    public function definiCriterioDeEntrega($cep, $peso)
    {
        $this->cep = $cep;
        $this->peso = $peso;
    }
}
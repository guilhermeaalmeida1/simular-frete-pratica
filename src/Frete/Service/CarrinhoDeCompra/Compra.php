<?php

namespace src\Frete\Service\CarrinhoDeCompra;

use src\Frete\Entity\User;
use src\Frete\Service\Shipping\ShippingInterface;


class Compra
{

    public function __construct(private ShippingInterface $correios)
    {
    }

    public function calculoDaCompra($valorDaCompra)
    {
        if ($valorDaCompra <= 100) {
            return $this->correios->calculaFrete() + $valorDaCompra;
        }
        return $valorDaCompra;
    }
}
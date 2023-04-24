<?php

namespace src\Frete\Service\CarrinhoDeCompra;

use src\Frete\Service\Correios\CorreiosInterface;

class Compra
{

    public function __construct(private CorreiosInterface $correios)
    {
    }

    public function calculoDaCompra($valorDaCompra)
    {
        if ($valorDaCompra <= 100) {
            return $valorDaCompra;
        }
        return $this->correios->calculaFrete() + $valorDaCompra;
    }
}
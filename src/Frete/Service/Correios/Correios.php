<?php

namespace src\Frete\Service\Correios;

class Correios implements CorreiosInterface
{

    public string $cep;

    public function calculaFrete()
    {
        return 1;
    }
}
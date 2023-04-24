<?php

namespace src\Frete\Entidades;

class Produto
{
    public string $nome;
    public string $valor;

    public function getProduto()
    {
        return [
            'nome' => $this->nome,
            'valor' => $this->valor
        ];
    }
}
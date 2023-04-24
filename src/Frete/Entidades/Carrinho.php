<?php

namespace src\Frete\Entidades;

use function PHPUnit\Framework\equalTo;

class Carrinho
{
    public Usuario $usuario;

    public array $listaDeProdutos;

    public function valorTotalDoCarrinho()
    {
        $total = 0;
        if (empty($this->listaDeProdutos)){
            return 0;
        }

        foreach ($this->listaDeProdutos as $listaDeProduto) {
            $total += $listaDeProduto['valor'];
        }

        return $total;
    }

    public function insertCompraCarrinho(array $produto)
    {
        if (empty($this->listaDeProdutos)){
            $this->listaDeProdutos[] = [
                "nome" => $produto['nome'],
                "valor" => $produto['valor']
            ];
            return;
        }

        foreach ($this->listaDeProdutos as $listaDeProduto) {
            if ($produto['nome'] !== $listaDeProduto['nome']) {
                $this->listaDeProdutos[] = [
                    "nome" => $produto['nome'],
                    "valor" => $produto['valor']
                ];
            }
        }
    }

    /**
     * @param array|null $produto
     * @return int|void
     */
    public function removeCompraCarrinho(array $produto = null)
    {
        if (empty($this->listaDeProdutos)){
            return 0;
        }

        foreach ($this->listaDeProdutos as $key => $listaDeProduto) {
            if ($produto['nome'] === $listaDeProduto['nome']) {
                unset($this->listaDeProdutos[$key]);
            }
        }
    }
}
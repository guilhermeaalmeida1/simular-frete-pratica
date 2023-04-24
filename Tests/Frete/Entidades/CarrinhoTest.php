<?php

namespace Tests\Frete\Entidades;

use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Entidades\Carrinho;
use PHPUnit\Framework\TestCase;
use src\Frete\Entidades\Produto;
use src\Frete\Entidades\Usuario;
use src\Frete\Service\CarrinhoDeCompra\Compra;
use src\Frete\Service\Correios\Correios;
use src\Frete\Service\Correios\CorreiosInterface;
use Mockery;

#[CoversClass(Usuario::class)]
#[CoversClass(Carrinho::class)]
#[CoversClass(Produto::class)]
#[CoversClass(Compra::class)]
#[CoversClass(Correios::class)]

class CarrinhoTest extends TestCase
{
    public Usuario $usuario;
    public Carrinho $carrinho;
    public Produto $produto;

    protected function setUp():void
    {
        $this->usuario = new Usuario();

        $this->carrinho = new Carrinho();

        $this->produto = new Produto();
    }

    public function testValorTotalDoCarrinhoSeEstiverVazio()
    {
        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";
        $this->carrinho->usuario = $this->usuario;

        $this->assertEquals($this->carrinho->valorTotalDoCarrinho(), 0);

    }

    public function testValorTotalDoCarrinhoSeEstiverComUmProduto()
    {
        $this->produto->nome = "prod1";
        $this->produto->valor = 10;

        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";
        $this->carrinho->usuario = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->valorTotalDoCarrinho(), 10);
    }

    public function testValorTotalDoCarrinhoSeEstiverComMaisDeUmProduto()
    {
        $this->produto->nome = "prod1";
        $this->produto->valor = 10;

        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";
        $this->carrinho->usuario = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->produto->nome = "prod12";
        $this->produto->valor = 10;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->valorTotalDoCarrinho(), 20);
    }

    public function testValorTotalDoCarrinhoSeEstiverComUmProdutoIgual()
    {
        $this->produto->nome = "prod1";
        $this->produto->valor = 10;

        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";
        $this->carrinho->usuario = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->produto->nome = "prod1";
        $this->produto->valor = 10;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->valorTotalDoCarrinho(), 10);
    }

    public function testRemocaoDoCarrinho()
    {
        $this->produto->nome = "prod1";
        $this->produto->valor = 10;

        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";
        $this->carrinho->usuario = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->produto->nome = "prod12";
        $this->produto->valor = 10;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->carrinho->removeCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->valorTotalDoCarrinho(), 10);
    }

    public function testRemocaoDoCarrinhoVazio()
    {
        $this->assertEquals($this->carrinho->removeCompraCarrinho(), 0);
    }

    public function testInterfaceDoCorreio()
    {
        $correios = Mockery::mock( CorreiosInterface::class);
        $correios->shouldReceive('calculaFrete')->andReturn(1);

        $this->produto->nome = "prod1";
        $this->produto->valor = 101;

        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";
        $this->carrinho->usuario = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $comp = new Compra($correios);
        $this->assertEquals($comp->calculoDaCompra($this->carrinho->valorTotalDoCarrinho()), 102);
    }

    public function tearDown():void
    {
        Mockery::close();
    }
}

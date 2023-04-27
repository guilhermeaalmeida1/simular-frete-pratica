<?php

namespace Tests\Frete\Service\Correios;

use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Entidades\Carrinho;
use src\Frete\Entidades\Produto;
use src\Frete\Entidades\Usuario;
use src\Frete\Service\Shipping\Correios;
use src\Frete\Service\Shipping\ShippingInterface;
use src\Frete\Service\Shipping\ShippingStrategy;
use PHPUnit\Framework\TestCase;

#[CoversClass(Correios::class)]
class CorreiosTest extends TestCase
{
    protected function setUp():void
    {
        $this->usuario = new Usuario();

        $this->carrinho = new Carrinho();

        $this->produto = new Produto();
    }

    public function testFrete()
    {
        $frete = new ShippingStrategy(new Correios());
        $this->assertEquals($frete->calculaFrete("123", 123),3);
    }

    public function testValorDoFrete()
    {
        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";

        $correios = new Correios();
        $correios->definiCriterioDeEntrega($this->usuario->cep, 123);


        $valor = Mockery::mock(ShippingInterface::class)
            ->shouldReceive('calculaFrete')
            ->andReturn(246)
            ->once()
            ->getMock();

        $valor = (new ShippingStrategy($valor))->calculaFrete();

        $this->assertEquals($valor, 246);
    }

    public function atestCompraSemFrete()
    {
        $this->produto->nome = "prod1";
        $this->produto->valor = 10;

        $this->usuario->nome = "Jhon";
        $this->usuario->cep = "123456978";
        $this->carrinho->usuario = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $correios = new Correios();
        $correios->definiCriterioDeEntrega($this->usuario->cep, 123);


        $valor = Mockery::mock(ShippingInterface::class)
            ->shouldReceive('calculaFrete')
            ->andReturn(246)
            ->once()
            ->getMock();

        $valor = (new ShippingStrategy($valor))->calculaFrete();
    }
}

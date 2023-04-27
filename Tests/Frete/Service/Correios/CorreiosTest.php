<?php

namespace Tests\Frete\Service\Correios;

use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Entity\Cart;
use src\Frete\Entity\Product;
use src\Frete\Entity\User;
use src\Frete\Service\Shipping\Correios;
use src\Frete\Service\Shipping\ShippingInterface;
use src\Frete\Service\Shipping\ShippingStrategy;
use PHPUnit\Framework\TestCase;

#[CoversClass(Correios::class)]
#[CoversClass(ShippingStrategy::class)]
class CorreiosTest extends TestCase
{
    protected function setUp():void
    {
        $this->usuario = new User();

        $this->carrinho = new Cart();

        $this->produto = new Product();
    }

    public function testFrete()
    {
        $frete = new ShippingStrategy(new Correios());
        $this->assertEquals($frete->calculaFrete("123", 123),3);
    }

    public function testValorDoFrete()
    {
        $this->usuario->name = "Jhon";
        $this->usuario->zipCode = "123456978";

        $correios = new Correios();
        $correios->definiCriterioDeEntrega($this->usuario->zipCode, 123);


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
        $this->produto->name = "prod1";
        $this->produto->price = 10;

        $this->usuario->name = "Jhon";
        $this->usuario->zipCode = "123456978";
        $this->carrinho->user = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $correios = new Correios();
        $correios->definiCriterioDeEntrega($this->usuario->zipCode, 123);


        $valor = Mockery::mock(ShippingInterface::class)
            ->shouldReceive('calculaFrete')
            ->andReturn(246)
            ->once()
            ->getMock();

        $valor = (new ShippingStrategy($valor))->calculaFrete();
    }
}

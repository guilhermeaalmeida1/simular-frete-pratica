<?php

namespace Tests\Frete\Service\CarrinhoDeCompra;

use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Service\CarrinhoDeCompra\Compra;
use PHPUnit\Framework\TestCase;
use src\Frete\Service\Shipping\Correios;
use src\Frete\Service\Shipping\ShippingInterface;
use src\Frete\Service\Shipping\ShippingStrategy;

#[CoversClass(ShippingStrategy::class)]
#[CoversClass(Correios::class)]
#[CoversClass(Compra::class)]
class CompraTest extends TestCase
{
    public function testCompraSemFrete()
    {
        $shipp = Mockery::mock(ShippingInterface::class);

        $this->assertEquals((new Compra($shipp))->calculoDaCompra(101), 101);
    }

    public function testCompraComFrete()
    {
        $shipp = Mockery::mock(ShippingInterface::class)
            ->shouldReceive('calculaFrete')
            ->andReturn(1)
            ->once()
            ->getMock();

//        $correios = new Correios();
//        $correios->definiCriterioDeEntrega("123", 10);

        $compra = (new Compra($shipp))->calculoDaCompra(99);

        $this->assertEquals($compra, 100);
    }
}

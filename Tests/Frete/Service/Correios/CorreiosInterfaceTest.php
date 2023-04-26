<?php

namespace Tests\Frete\Service\Correios;

use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Service\Shipping\ShippingInterface;
use src\Frete\Service\Shipping\ShippingStrategy;
use PHPUnit\Framework\TestCase;

#[CoversClass(ShippingInterface::class)]
class CorreiosInterfaceTest extends TestCase
{

    public function testInterfaceExiste()
    {
        $rr = $this->createMock(ShippingInterface::class);

        $this->assertInstanceOf(ShippingStrategy::class, $rr);
    }

    public function testFuncaInterfaceExiste()
    {
        $this->assertTrue(method_exists(ShippingInterface::class, 'calculaFrete'));
    }
}

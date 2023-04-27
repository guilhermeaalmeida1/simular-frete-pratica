<?php

namespace Tests\Frete\Service\Correios;

use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Service\Shipping\ShippingInterface;
use PHPUnit\Framework\TestCase;

#[CoversClass(ShippingInterface::class)]
class CorreiosInterfaceTest extends TestCase
{
    public function testFuncaInterfaceExiste()
    {
        $this->assertTrue(method_exists(ShippingInterface::class, 'calculaFrete'));
    }
}

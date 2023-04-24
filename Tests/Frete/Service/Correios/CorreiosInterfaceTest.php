<?php

namespace Tests\Frete\Service\Correios;

use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Service\Correios\CorreiosInterface;
use PHPUnit\Framework\TestCase;

#[CoversClass(CorreiosInterface::class)]
class CorreiosInterfaceTest extends TestCase
{

    public function testInterfaceExiste()
    {
        $rr = $this->createMock(CorreiosInterface::class);

        $this->assertInstanceOf(CorreiosInterface::class, $rr);
    }

    public function testFuncaInterfaceExiste()
    {
        $this->assertTrue(method_exists(CorreiosInterface::class, 'calculaFrete'));
    }
}

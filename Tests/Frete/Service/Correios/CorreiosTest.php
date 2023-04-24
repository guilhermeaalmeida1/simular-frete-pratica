<?php

namespace Tests\Frete\Service\Correios;

use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Service\Correios\Correios;
use PHPUnit\Framework\TestCase;

#[CoversClass(Correios::class)]
class CorreiosTest extends TestCase
{
    public function testFrete()
    {
        $frete = new Correios();
        $this->assertEquals($frete->calculaFrete(),1);
    }
}

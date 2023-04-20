<?php
// Arquivo Exemplo: ExemploTest.php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Calculadora;

class ExemploTest extends TestCase
{
    private $calculadora;

    protected function setUp(): void
    {
        $this->calculadora = new Calculadora();
    }

    protected function tearDown(): void
    {
        $this->calculadora = null;
    }

    public function testAddition(): void
    {
        $result = $this->calculadora->add(2, 3);
        $this->assertEquals(5, $result);
    }

    public function testSubtraction(): void
    {
        $result = $this->calculadora->subtract(5, 2);
        $this->assertEquals(3, $result);
    }

    public function testMultiplication(): void
    {
        $result = $this->calculadora->multiply(4, 6);
        $this->assertEquals(24, $result);
    }

    public function testDivision(): void
    {
        $result = $this->calculadora->divide(10, 2);
        $this->assertEquals(5, $result);
    }
}

<?php
// Arquivo Exemplo: ExemploTest.php

use PHPUnit\Framework\TestCase;

class ExemploTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    protected function tearDown(): void
    {
        $this->calculator = null;
    }

    public function testAddition(): void
    {
        $result = $this->calculator->add(2, 3);
        $this->assertEquals(5, $result);
    }

    public function testSubtraction(): void
    {
        $result = $this->calculator->subtract(5, 2);
        $this->assertEquals(3, $result);
    }

    public function testMultiplication(): void
    {
        $result = $this->calculator->multiply(4, 6);
        $this->assertEquals(24, $result);
    }

    public function testDivision(): void
    {
        $result = $this->calculator->divide(10, 2);
        $this->assertEquals(5, $result);
    }
}

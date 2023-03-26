<?php

require_once "modelo/ejemplo_class.php";

use PHPUnit\Framework\TestCase;

class EjemploTest extends TestCase
{
    private $ejemplo;

    protected function setUp(): void
    {$this->ejemplo = new ejemplo_Class();}

    protected function tearDown(): void
    {$this->ejemplo = null;}

    public function test_01()
    {
        $this->assertTrue(true);
    }
}

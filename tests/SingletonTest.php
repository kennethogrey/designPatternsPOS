<?php
use PHPUnit\Framework\TestCase;
use App\Products;

class SingletonTest extends TestCase
{
    public function testGetInstanceReturnsSameInstance()
    {
        $_SERVER['REQUEST_URI'] = "/test";
        $instance1 = Products::getInstance();
        $instance2 = Products::getInstance();

        $this->assertSame($instance1, $instance2);
    }
}

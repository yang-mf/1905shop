<?php

namespace test\Mockery;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Exception;

class ProxyMockingTest extends MockeryTestCase
{
    /** @Test */
    public function finalClassCannotBeMocked()
    {
        $this->expectException(Exception::class);

        mock(UnmockableClass::class);
    }

    /** @Test */
    public function passesThruAnyMethod()
    {
        $mock = mock(new UnmockableClass());

        $this->assertSame(1, $mock->anyMethod());
    }

    /** @Test */
    public function passesThruVirtualMethods()
    {
        $mock = mock(new UnmockableClass());

        $this->assertSame(42, $mock->theAnswer());
    }
}

final class UnmockableClass
{
    public function anyMethod()
    {
        return 1;
    }

    public function __call($method, $args)
    {
        return 42;
    }
}

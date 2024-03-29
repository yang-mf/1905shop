<?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace test\Mockery;

use Mockery\Adapter\Phpunit\MockeryTestCase;

class MockingProtectedMethodsTest extends MockeryTestCase
{
    /**
     * @Test
     *
     * This is a regression Test, basically we don't want the mock handling
     * interfering with calling protected methods partials
     */
    public function shouldAutomaticallyDeferCallsToProtectedMethodsForPartials()
    {
        $mock = mock("Test\Mockery\TestWithProtectedMethods[foo]");
        $this->assertEquals("bar", $mock->bar());
    }

    /**
     * @Test
     *
     * This is a regression Test, basically we don't want the mock handling
     * interfering with calling protected methods partials
     */
    public function shouldAutomaticallyDeferCallsToProtectedMethodsForRuntimePartials()
    {
        $mock = mock("Test\Mockery\TestWithProtectedMethods")->makePartial();
        $this->assertEquals("bar", $mock->bar());
    }

    /** @Test */
    public function shouldAutomaticallyIgnoreAbstractProtectedMethods()
    {
        $mock = mock("Test\Mockery\TestWithProtectedMethods")->makePartial();
        $this->assertNull($mock->foo());
    }

    /** @Test */
    public function shouldAllowMockingProtectedMethods()
    {
        $mock = mock("Test\Mockery\TestWithProtectedMethods")
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $mock->shouldReceive("protectedBar")->andReturn("notbar");
        $this->assertEquals("notbar", $mock->bar());
    }

    /** @Test */
    public function shouldAllowMockingProtectedMethodOnDefinitionTimePartial()
    {
        $mock = mock("Test\Mockery\TestWithProtectedMethods[protectedBar]")
            ->shouldAllowMockingProtectedMethods();

        $mock->shouldReceive("protectedBar")->andReturn("notbar");
        $this->assertEquals("notbar", $mock->bar());
    }

    /** @Test */
    public function shouldAllowMockingAbstractProtectedMethods()
    {
        $mock = mock("Test\Mockery\TestWithProtectedMethods")
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $mock->shouldReceive("abstractProtected")->andReturn("abstractProtected");
        $this->assertEquals("abstractProtected", $mock->foo());
    }

    /** @Test */
    public function shouldAllowMockingIncreasedVisabilityMethods()
    {
        $mock = mock("Test\Mockery\TestIncreasedVisibilityChild");
        $mock->shouldReceive('foobar')->andReturn("foobar");
        $this->assertEquals('foobar', $mock->foobar());
    }
}


abstract class TestWithProtectedMethods
{
    public function foo()
    {
        return $this->abstractProtected();
    }

    abstract protected function abstractProtected();

    public function bar()
    {
        return $this->protectedBar();
    }

    protected function protectedBar()
    {
        return 'bar';
    }
}

class TestIncreasedVisibilityParent
{
    protected function foobar()
    {
    }
}

class TestIncreasedVisibilityChild extends TestIncreasedVisibilityParent
{
    public function foobar()
    {
    }
}

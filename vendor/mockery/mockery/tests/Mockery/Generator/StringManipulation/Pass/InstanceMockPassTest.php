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

namespace Mockery\Test\Generator\StringManipulation\Pass;

use Mockery as m;
use Mockery\Generator\MockConfigurationBuilder;
use Mockery\Generator\StringManipulation\Pass\InstanceMockPass;
use PHPUnit\Framework\TestCase;

class InstanceMockPassTest extends TestCase
{
    /**
     * @Test
     */
    public function shouldAppendConstructorAndPropertyForInstanceMock()
    {
        $builder = new MockConfigurationBuilder;
        $builder->setInstanceMock(true);
        $config = $builder->getMockConfiguration();
        $pass = new InstanceMockPass;
        $code = $pass->apply('class Dave { }', $config);
        $this->assertTrue(\mb_strpos($code, 'public function __construct') !== false);
        $this->assertTrue(\mb_strpos($code, 'protected $_mockery_ignoreVerification') !== false);
        $this->assertTrue(\mb_strpos($code, 'this->_mockery_constructorCalled(func_get_args());') !== false);
    }
}

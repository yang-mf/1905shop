<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\TestCase;

class Issue1348Test extends TestCase
{
    public function testSTDOUT(): void
    {
        \fwrite(\STDOUT, "\nSTDOUT does not break Test result\n");
        $this->assertTrue(true);
    }

    public function testSTDERR(): void
    {
        \fwrite(\STDERR, 'STDERR works as usual.');
    }
}

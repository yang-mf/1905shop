<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Tests\Extractor;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Extractor\PhpExtractor;
use Symfony\Component\Translation\MessageCatalogue;

class PhpExtractorTest extends TestCase
{
    /**
     * @dataProvider resourcesProvider
     *
     * @param array|string $resource
     */
    public function testExtraction($resource)
    {
        // Arrange
        $extractor = new PhpExtractor();
        $extractor->setPrefix('prefix');
        $catalogue = new MessageCatalogue('en');

        // Act
        $extractor->extract($resource, $catalogue);

        $expectedHeredoc = <<<EOF
heredoc key with whitespace and escaped \$\n sequences
EOF;
        $expectedNowdoc = <<<'EOF'
nowdoc key with whitespace and nonescaped \$\n sequences
EOF;
        // Assert
        $expectedCatalogue = [
            'messages' => [
                'single-quoted key' => 'prefixsingle-quoted key',
                'double-quoted key' => 'prefixdouble-quoted key',
                'heredoc key' => 'prefixheredoc key',
                'nowdoc key' => 'prefixnowdoc key',
                "double-quoted key with whitespace and escaped \$\n\" sequences" => "prefixdouble-quoted key with whitespace and escaped \$\n\" sequences",
                'single-quoted key with whitespace and nonescaped \$\n\' sequences' => 'prefixsingle-quoted key with whitespace and nonescaped \$\n\' sequences',
                'single-quoted key with "quote mark at the end"' => 'prefixsingle-quoted key with "quote mark at the end"',
                $expectedHeredoc => 'prefix'.$expectedHeredoc,
                $expectedNowdoc => 'prefix'.$expectedNowdoc,
                '{0} There is no apples|{1} There is one apple|]1,Inf[ There are %count% apples' => 'prefix{0} There is no apples|{1} There is one apple|]1,Inf[ There are %count% apples',
                'concatenated message with heredoc and nowdoc' => 'prefixconcatenated message with heredoc and nowdoc',
                'default domain' => 'prefixdefault domain',
            ],
            'not_messages' => [
                'other-domain-Test-no-params-short-array' => 'prefixother-domain-Test-no-params-short-array',
                'other-domain-Test-no-params-long-array' => 'prefixother-domain-Test-no-params-long-array',
                'other-domain-Test-params-short-array' => 'prefixother-domain-Test-params-short-array',
                'other-domain-Test-params-long-array' => 'prefixother-domain-Test-params-long-array',
                'other-domain-Test-trans-choice-short-array-%count%' => 'prefixother-domain-Test-trans-choice-short-array-%count%',
                'other-domain-Test-trans-choice-long-array-%count%' => 'prefixother-domain-Test-trans-choice-long-array-%count%',
                'typecast' => 'prefixtypecast',
                'msg1' => 'prefixmsg1',
                'msg2' => 'prefixmsg2',
            ],
        ];
        $actualCatalogue = $catalogue->all();

        $this->assertEquals($expectedCatalogue, $actualCatalogue);

        $filename = str_replace(\DIRECTORY_SEPARATOR, '/', __DIR__).'/../fixtures/extractor/translation.html.php';
        $this->assertEquals(['sources' => [$filename.':2']], $catalogue->getMetadata('single-quoted key'));
        $this->assertEquals(['sources' => [$filename.':43']], $catalogue->getMetadata('other-domain-Test-no-params-short-array', 'not_messages'));
    }

    public function resourcesProvider()
    {
        $directory = __DIR__.'/../fixtures/extractor/';
        $splFiles = [];
        foreach (new \DirectoryIterator($directory) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            if ('translation.html.php' === $fileInfo->getBasename()) {
                $phpFile = $fileInfo->getPathname();
            }
            $splFiles[] = $fileInfo->getFileInfo();
        }

        return [
            [$directory],
            [$phpFile],
            [glob($directory.'*')],
            [$splFiles],
            [new \ArrayObject(glob($directory.'*'))],
            [new \ArrayObject($splFiles)],
        ];
    }
}
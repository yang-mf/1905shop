<?php

/* Copyright (c) 2013-2019 Geert Bergman (geert@scrivo.nl), highlight.php
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 * 3. Neither the name of "highlight.js", "highlight.php", nor the names of its
 *    contributors may be used to endorse or promote products derived from this
 *    software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

use Highlight\Highlighter;
use Symfony\Component\Finder\Finder;

class HighlightAutoTest extends PHPUnit_Framework_TestCase
{
    private $allowedFailures;

    public function setUp()
    {
        $this->allowedFailures = array(
            'http',
            'java',
            'livescript',
            'shell',
            'plaintext',
            'coffeescript',
            'handlebars',
        );
    }

    public static function detectableLanguagesProvider()
    {
        $testData = array();

        $languages = new Finder();
        $languages
            ->in(__DIR__ . '/detect/')
            ->sortByName()
            ->files()
        ;

        foreach ($languages as $language) {
            $testData[] = array($language->getRelativePath(), $language->getContents());
        }

        return $testData;
    }

    /**
     * @dataProvider detectableLanguagesProvider
     */
    public function testAutomaticDetection($language, $raw)
    {
        $hl = new Highlighter();
        $hl->setAutodetectLanguages($hl->listLanguages());

        $actual = $hl->highlightAuto($raw);

        $errMessage = sprintf(
            "Expected language: %s; [1. %s (%d%%); 2. %s (%d%%)]",
            $language,
            $actual->language,
            $actual->relevance,
            $actual->secondBest->language,
            $actual->secondBest->relevance
        );

        if (in_array($language, $this->allowedFailures)) {
            $this->markTestSkipped("The '$language' auto-detection Test is known to fail: $errMessage");
        }

        $this->assertEquals($language, $actual->language, $errMessage);
    }
}

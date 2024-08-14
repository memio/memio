<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Collection\Phpdoc;

use Memio\Memio\Examples\PrettyPrinterTestCase;
use Memio\Model\Phpdoc\ParameterTag;

class ParameterTagCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroParameterTags()
    {
        $parameterTags = [];

        $generatedCode = $this->prettyPrinter->generateCode($parameterTags);

        $this->assertSame('', $generatedCode);
    }

    public function testOneParameterTag()
    {
        $parameterTags = [
            new ParameterTag('string', 'filename'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($parameterTags);

        $this->assertSame('@param string $filename', $generatedCode);
    }

    public function testThreeParameterTags()
    {
        $parameterTags = [
            new ParameterTag('Symfony\Component\HttpFoundation\Request', 'request'),
            new ParameterTag('int', 'type'),
            new ParameterTag('bool', 'catch'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($parameterTags);

        $this->assertExpectedCode($generatedCode);
    }
}

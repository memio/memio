<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Collection\Phpdoc;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Phpdoc\ParameterTag;

class ParameterTagCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroParameterTags()
    {
        $parameterTags = array();

        $generatedCode = $this->prettyPrinter->generateCode($parameterTags);

        $this->assertSame('', $generatedCode);
    }

    public function testOneParameterTag()
    {
        $parameterTags = array(
            new ParameterTag('string', 'filename'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($parameterTags);

        $this->assertSame('@param string $filename', $generatedCode);
    }

    public function testThreeParameterTags()
    {
        $parameterTags = array(
            new ParameterTag('Symfony\Component\HttpFoundation\Request', 'request'),
            new ParameterTag('int', 'type'),
            new ParameterTag('bool', 'catch'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($parameterTags);

        $this->assertExpectedCode($generatedCode);
    }
}

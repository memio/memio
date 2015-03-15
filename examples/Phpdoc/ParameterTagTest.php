<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Phpdoc;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Phpdoc\ParameterTag;

class ParameterTagTest extends PrettyPrinterTestCase
{
    public function testSimple()
    {
        $parameterTag = new ParameterTag('Gnugat\Medio\MyClass', 'myClass');

        $generatedCode = $this->prettyPrinter->generateCode($parameterTag);

        $this->assertSame('@param MyClass $myClass', $generatedCode);
    }

    public function testWithDescription()
    {
        $parameterTag = new ParameterTag('Gnugat\Medio\MyClass', 'myClass', 'description');

        $generatedCode = $this->prettyPrinter->generateCode($parameterTag);

        $this->assertSame('@param MyClass $myClass description', $generatedCode);
    }
}

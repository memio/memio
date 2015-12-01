<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Phpdoc;

use Memio\Memio\Examples\PrettyPrinterTestCase;
use Memio\Model\Phpdoc\ApiTag;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\DeprecationTag;
use Memio\Model\Phpdoc\MethodPhpdoc;
use Memio\Model\Phpdoc\ParameterTag;

class MethodPhpdocTest extends PrettyPrinterTestCase
{
    public function testEmpty()
    {
        $methodPhpdoc = new MethodPhpdoc();

        $generatedCode = $this->prettyPrinter->generateCode($methodPhpdoc);

        $this->assertSame('', $generatedCode);
    }

    public function testOneTag()
    {
        $methodPhpdoc = MethodPhpdoc::make()
            ->setApiTag(new ApiTag())
        ;

        $generatedCode = $this->prettyPrinter->generateCode($methodPhpdoc);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $methodPhpdoc = MethodPhpdoc::make()
            ->setDescription(Description::make('Short description')
                ->addEmptyLine()
                ->addLine('Longer description')
            )

            ->addParameterTag(new ParameterTag('Memio\Memio\MyClass', 'myClass'))

            ->setDeprecationTag(new DeprecationTag('v2.1', 'Use Object instead'))
            ->setApiTag(new ApiTag('v2.0'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($methodPhpdoc);

        $this->assertExpectedCode($generatedCode);
    }
}

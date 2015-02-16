<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Type;

class MethodTest extends PrettyPrinterTestCase
{
    public function testWithoutArguments()
    {
        $method = new Method('isEnabled');

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithInlineArguments()
    {
        $method = new Method('it_has_too_many_argument_yes');
        for ($i = 1; $i < 7; $i++) {
            $method->addArgument(new Argument(new Type('string'), 'argument'.$i));
        }

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithMultilineArguments()
    {
        $method = new Method('it_has_too_many_argument_yeah');
        for ($i = 1; $i < 7; $i++) {
            $method->addArgument(new Argument(new Type('string'), 'argument'.$i));
        }

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testNoVisibility()
    {
        $method = Method::make('it_has_phpspec_style')
            ->removeVisibility()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testPrivateVisibility()
    {
        $method = Method::make('extractMe')
            ->makePrivate()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testProtectedVisibility()
    {
        $method = Method::make('inheritanceIsBad')
            ->makeProtected()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }
}

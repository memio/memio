<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Collection;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Type;
use Gnugat\Medio\Model\Import;
use Gnugat\Medio\ValueObject\Collection;

class MethodCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroMethods()
    {
        $methodCollection = new Collection('Gnugat\\Medio\\Model\\Method');

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneMethod()
    {
        $methodCollection = Collection::make('Gnugat\\Medio\\Model\\Method')
            ->add(new Method('__construct'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeMethods()
    {
        $methodCollection = Collection::make('Gnugat\\Medio\\Model\\Method')
            ->add(Method::make('__construct')
                ->addArgument(new Argument(new Type('DateTime'), 'dateTime'))
                ->addArgument(new Argument(new Type('ArrayObject'), 'arrayObject'))
            )
            ->add(new Method('getDateTime'))
            ->add(new Method('getArrayObject'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertExpectedCode($generatedCode);
    }
}

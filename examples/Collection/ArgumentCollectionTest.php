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
use Gnugat\Medio\ValueObject\Collection;

class ArgumentCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroArguments()
    {
        $argumentCollection = new Collection('Gnugat\\Medio\\Model\\Argument');

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneArgument()
    {
        $argumentCollection = Collection::make('Gnugat\\Medio\\Model\\Argument')
            ->add(new Argument('bool', 'isObject'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertSame('$isObject', $generatedCode);
    }

    public function testThreeArguments()
    {
        $argumentCollection = Collection::make('Gnugat\\Medio\\Model\\Argument')
            ->add(new Argument('\\SplFileInfo', 'file'))
            ->add(new Argument('string', 'newLine'))
            ->add(new Argument('int', 'lineNumber'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertSame('\\SplFileInfo $file, $newLine, $lineNumber', $generatedCode);
    }

    public function testTooManyArgumentsToBeOnOneLine()
    {
        $argumentCollection = new Collection('Gnugat\\Medio\\Model\\Argument');
        for ($i = 1; $i < 12; $i++) {
            $argumentCollection->add(new Argument('mixed', 'argument'.$i));
        }

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertExpectedCode($generatedCode);
    }

    public function testRestrictInlineLength()
    {
        $argumentCollection = new Collection('Gnugat\\Medio\\Model\\Argument');
        for ($i = 1; $i < 9; $i++) {
            $argumentCollection->add(new Argument('mixed', 'argument'.$i));
        }
        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection, array(
            'length_restriction' => strlen('    public function __construct()'),
        ));

        $this->assertExpectedCode($generatedCode);
    }
}

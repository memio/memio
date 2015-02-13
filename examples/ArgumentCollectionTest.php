<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\ArgumentCollection;
use Gnugat\Medio\Model\Type;

class ArgumentCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroArguments()
    {
        $argumentCollection = new ArgumentCollection();

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneArgument()
    {
        $argumentCollection = ArgumentCollection::make()
            ->add(new Argument(new Type('bool'), 'isObject'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertSame('$isObject', $generatedCode);
    }

    public function testThreeArguments()
    {
        $argumentCollection = ArgumentCollection::make()
            ->add(new Argument(new Type('\\SplFileInfo'), 'file'))
            ->add(new Argument(new Type('string'), 'newLine'))
            ->add(new Argument(new Type('int'), 'lineNumber'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertSame('\\SplFileInfo $file, $newLine, $lineNumber', $generatedCode);
    }

    public function testTooManyArgumentsToBeOnOneLine()
    {
        $argumentCollection = new ArgumentCollection();
        for ($i = 1; $i < 12; $i++) {
            $argumentCollection->add(new Argument(new Type('mixed'), 'argument'.$i));
        }

        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection);

        $this->assertExpectedCode($generatedCode);
    }

    public function testRestrictInlineLength()
    {
        $argumentCollection = new ArgumentCollection();
        for ($i = 1; $i < 9; $i++) {
            $argumentCollection->add(new Argument(new Type('mixed'), 'argument'.$i));
        }
        $generatedCode = $this->prettyPrinter->generateCode($argumentCollection, array(
            'length_restriction' => strlen('    public function __construct()'),
        ));

        $this->assertExpectedCode($generatedCode);
    }
}

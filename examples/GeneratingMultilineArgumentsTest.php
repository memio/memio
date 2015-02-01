<?php

namespace Gnugat\Medio\Examples;

use DI\ContainerBuilder;

class GeneratingMultilineArgumentsTest extends \PHPUnit_Framework_TestCase
{
    private $variableArgumentCollectionFactory;
    private $multilineArgumentCollectionPrinter;

    protected function setUp()
    {
        $container = ContainerBuilder::buildDevContainer();

        $this->variableArgumentCollectionFactory = $container->get('Gnugat\\Medio\\Factory\\VariableArgumentCollectionFactory');
        $this->multilineArgumentCollectionPrinter = $container->get('Gnugat\\Medio\\PrettyPrinter\\MultilineArgumentCollectionPrinter');
    }

    public function testNoArguments()
    {
        $variables = array();

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->multilineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }

    public function testOneArgument()
    {
        $variables = array('string');

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->multilineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }

    public function testManyArguments()
    {
        $variables = array('Nobody expects', 'the spanish inquisition');

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->multilineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }
}

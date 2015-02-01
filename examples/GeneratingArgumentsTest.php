<?php

namespace Gnugat\Medio\Examples;

use DI\ContainerBuilder;

class GeneratingArgumentsTest extends \PHPUnit_Framework_TestCase
{
    private $variableArgumentCollectionFactory;
    private $inlineArgumentCollectionPrinter;

    protected function setUp()
    {
        $container = ContainerBuilder::buildDevContainer();

        $this->variableArgumentCollectionFactory = $container->get('Gnugat\\Medio\\Factory\\VariableArgumentCollectionFactory');
        $this->inlineArgumentCollectionPrinter = $container->get('Gnugat\\Medio\\PrettyPrinter\\InlineArgumentCollectionPrinter');
    }

    public function testGenericNaming()
    {
        $variables = array('string');

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }

    public function testGenericNamingCollision()
    {
        $variables = array('string', true);

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }

    public function testObjectNaming()
    {
        $variables = array(new \stdClass(), new \DateTime(), $this->variableArgumentCollectionFactory);

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }

    public function testObjectNamingCollision()
    {
        $variables = array(new \stdClass(), new \stdClass());

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }

    public function testTypehints()
    {
        $variables = array(array(), new \stdClass(), function () {});

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }
}

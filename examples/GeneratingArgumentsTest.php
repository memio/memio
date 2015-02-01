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

        $this->assertSame($this->getExpectedCode('testGenericNaming'), $generatedCode);
    }

    public function testGenericNamingCollision()
    {
        $variables = array('string', true);

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame($this->getExpectedCode('testGenericNamingCollision'), $generatedCode);
    }

    public function testObjectNaming()
    {
        $variables = array(new \stdClass(), new \DateTime(), $this->variableArgumentCollectionFactory);

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame($this->getExpectedCode('testObjectNaming'), $generatedCode);
    }

    public function testObjectNamingCollision()
    {
        $variables = array(new \stdClass(), new \stdClass());

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame($this->getExpectedCode('testObjectNamingCollision'), $generatedCode);
    }

    public function testTypehints()
    {
        $variables = array(array(), new \stdClass(), function () {});

        $argumentCollection = $this->variableArgumentCollectionFactory->make($variables);
        $generatedCode = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

        $this->assertSame($this->getExpectedCode('testTypehints'), $generatedCode);
    }

    private function getExpectedCode($forTest)
    {
        $content = file_get_contents(__DIR__."/fixtures/GeneratingArgumentsTest/$forTest.txt");

        return rtrim($content, "\n"); // Fixtures all have an extra empty line at the end of the file.
    }
}

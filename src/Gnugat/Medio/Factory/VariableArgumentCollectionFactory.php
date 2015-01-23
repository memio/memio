<?php

namespace Gnugat\Medio\Factory;

use Gnugat\Medio\Model\ArgumentCollection;

class VariableArgumentCollectionFactory
{
    /**
     * @var VariableArgumentFactory
     */
    private $variableArgumentFactory;

    /**
     * @param VariableArgumentFactory $variableArgumentFactory
     */
    public function __construct(VariableArgumentFactory $variableArgumentFactory)
    {
        $this->variableArgumentFactory = $variableArgumentFactory;
    }

    /**
     * @param array $variables
     *
     * @return ArgumentCollection
     */
    public function make(array $variables)
    {
        $argumentCollection = new ArgumentCollection();
        foreach ($variables as $variable) {
            $argument = $this->variableArgumentFactory->make($variable);
            $argumentCollection->add($argument);
        }

        return $argumentCollection;
    }
}

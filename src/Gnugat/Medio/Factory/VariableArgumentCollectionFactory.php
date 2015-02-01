<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Factory;

use Gnugat\Medio\Model\ArgumentCollection;

/**
 * Creates an ArgumentCollection from an array of variables.
 *
 * @api
 */
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

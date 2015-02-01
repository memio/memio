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

use Gnugat\Medio\Model\Argument;

class VariableArgumentFactory
{
    /**
     * @var VariableTypeFactory
     */
    private $variableTypeFactory;

    /**
     * @param VariableTypeFactory $variableTypeFactory
     */
    public function __construct(VariableTypeFactory $variableTypeFactory)
    {
        $this->variableTypeFactory = $variableTypeFactory;
    }

    /**
     * @param mixed $variable
     *
     * @return Argument
     */
    public function make($variable)
    {
        $type = $this->variableTypeFactory->make($variable);
        if (!$type->isObject()) {
            return new Argument($type, 'argument');
        }
        $nameSpaces = explode('\\', $type->getName());
        $className = end($nameSpaces);
        $name = lcfirst($className);

        return new Argument($type, $name);
    }
}

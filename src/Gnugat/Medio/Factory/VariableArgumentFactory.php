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
     * @var TypeArgumentFactory
     */
    private $typeArgumentFactory;

    /**
     * @param TypeArgumentFactory $typeArgumentFactory
     */
    public function __construct(TypeArgumentFactory $typeArgumentFactory)
    {
        $this->typeArgumentFactory = $typeArgumentFactory;
    }

    /**
     * @param mixed $variable
     *
     * @return Argument
     */
    public function make($variable)
    {
        if (is_callable($variable)) {
            return $this->typeArgumentFactory->make('callable');
        }
        if (is_object($variable)) {
            return $this->typeArgumentFactory->make(get_class($variable));
        }

        return $this->typeArgumentFactory->make(gettype($variable));
    }
}

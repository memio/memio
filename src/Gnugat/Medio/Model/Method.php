<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Model;

class Method
{
    /**
     * @var ArgumentCollection
     */
    private $argumentCollection;

    /**
     * @var string
     */
    private $name;

    /**
     * @param ArgumentCollection $argumentCollection
     * @param string             $name
     */
    public function __construct(ArgumentCollection $argumentCollection, $name)
    {
        $this->argumentCollection = $argumentCollection;
        $this->name = $name;
    }

    /**
     * @return ArgumentCollection
     */
    public function getArgumentCollection()
    {
        return $this->argumentCollection;
    }

    /**
     * @param Argument $argument
     */
    public function addArgument(Argument $argument)
    {
        $this->argumentCollection->add($argument);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

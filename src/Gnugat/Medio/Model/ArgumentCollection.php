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

/**
 * @api
 */
class ArgumentCollection
{
    /**
     * @var array
     */
    private $arguments = array();

    /**
     * @var array
     */
    private $nameCount = array();

    /**
     * @return array
     */
    public function all()
    {
        return $this->arguments;
    }

    /**
     * @param Argument $argument
     *
     * @api
     */
    public function add(Argument $argument)
    {
        $name = $argument->getName();
        $this->nameCount[$name] = (isset($this->nameCount[$name]) ? $this->nameCount[$name] + 1 : 1);
        if ($this->nameCount[$name] > 1) {
            $argument->rename($name.$this->nameCount[$name]);
        }
        $this->arguments[] = $argument;
        if ($this->nameCount[$name] !== 2) {
            return;
        }
        foreach ($this->arguments as $argument) {
            if ($argument->getName() === $name) {
                $argument->rename($name.'1');
            }
        }
    }
}

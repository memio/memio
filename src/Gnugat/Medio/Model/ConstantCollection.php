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

use Gnugat\Medio\Exception\InvalidArgumentException;

/**
 * @api
 */
class ConstantCollection
{
    /**
     * @var array
     */
    private $constants = array();

    /**
     * @return ConstantCollection
     *
     * @api
     */
    public static function make()
    {
        return new self();
    }

    /**
     * @param Constant $constant
     *
     * @return ConstantCollection
     *
     * @throws InvalidArgumentException If the name is already taken
     *
     * @api
     */
    public function add(Constant $constant)
    {
        $name = $constant->getName();
        $message = sprintf('Cannot add constant "%s", risk of name duplication', $name);
        foreach ($this->constants as $addedConstant) {
            if ($name === $addedConstant->getName()) {
                throw new InvalidArgumentException($message);
            }
        }
        $this->constants[] = $constant;

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->constants;
    }
}

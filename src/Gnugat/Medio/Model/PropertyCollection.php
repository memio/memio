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
class PropertyCollection
{
    /**
     * @var array
     */
    private $properties = array();

    /**
     * @return PropertyCollection
     *
     * @api
     */
    public static function make()
    {
        return new self();
    }

    /**
     * @param Property $property
     *
     * @return PropertyCollection
     *
     * @throws InvalidArgumentException If the name is already taken
     *
     * @api
     */
    public function add(Property $property)
    {
        $name = $property->getName();
        $message = sprintf('Cannot add property "%s", risk of name duplication', $name);
        foreach ($this->properties as $addedProperty) {
            if ($name === $addedProperty->getName()) {
                throw new InvalidArgumentException($message);
            }
        }
        $this->properties[] = $property;

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->properties;
    }
}

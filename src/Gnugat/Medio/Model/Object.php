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

use Gnugat\Medio\ValueObject\Collection;

/**
 * A PHP Class ("class" is a reserved word and cannot be used as classname).
 *
 * @api
 */
class Object implements Structure
{
    /**
     * @var Collection
     */
    private $constants;

    /**
     * @var Collection
     */
    private $methods;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $properties;

    /**
     * @param string $name
     *
     * @api
     */
    public function __construct($name)
    {
        $this->constants = new Collection('Gnugat\\Medio\\Model\\Constant');
        $this->methods = new Collection('Gnugat\\Medio\\Model\\Method');
        $this->name = $name;
        $this->properties = new Collection('Gnugat\\Medio\\Model\\Property');
    }

    /**
     * @param string $name
     *
     * @return Object
     *
     * @api
     */
    public static function make($name)
    {
        return new self($name);
    }

    /**
     * @param Constant $constant
     *
     * @return Object
     *
     * @api
     */
    public function addConstant(Constant $constant)
    {
        $this->constants->add($constant);

        return $this;
    }

    /**
     * @return array
     */
    public function allConstants()
    {
        return $this->constants->all();
    }

    /**
     * @param Method $method
     *
     * @return Object
     *
     * @api
     */
    public function addMethod(Method $method)
    {
        $this->methods->add($method);

        return $this;
    }

    /**
     * @return array
     */
    public function allMethods()
    {
        return $this->methods->all();
    }

    /**
     * @param Property $property
     *
     * @return Object
     *
     * @api
     */
    public function addProperty(Property $property)
    {
        $this->properties->add($property);

        return $this;
    }

    /**
     * @return array
     */
    public function allProperties()
    {
        return $this->properties->all();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }
}

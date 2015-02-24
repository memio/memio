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
use Gnugat\Medio\ValueObject\FullyQualifiedName;

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
     * @var FullyQualifiedName
     */
    private $fullyQualifiedName;

    /**
     * @var Collection
     */
    private $methods;

    /**
     * @var Collection
     */
    private $properties;

    /**
     * @param string $fullyQualifiedName
     *
     * @api
     */
    public function __construct($fullyQualifiedName)
    {
        $this->constants = new Collection('Gnugat\\Medio\\Model\\Constant');
        $this->fullyQualifiedName = new FullyQualifiedName($fullyQualifiedName);
        $this->methods = new Collection('Gnugat\\Medio\\Model\\Method');
        $this->properties = new Collection('Gnugat\\Medio\\Model\\Property');
    }

    /**
     * @param string $fullyQualifiedName
     *
     * @return Object
     *
     * @api
     */
    public static function make($fullyQualifiedName)
    {
        return new self($fullyQualifiedName);
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
    public function getFullyQualifiedName()
    {
        return $this->fullyQualifiedName->getFullyQualifiedName();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->fullyQualifiedName->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return $this->fullyQualifiedName->getNamespace();
    }
}

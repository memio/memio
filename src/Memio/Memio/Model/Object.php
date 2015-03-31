<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Model;

use Memio\Memio\Model\Phpdoc\StructurePhpdoc;

/**
 * A PHP Class ("class" is a reserved word and cannot be used as classname).
 *
 * @api
 */
class Object implements Structure
{
    /**
     * @var array
     */
    private $constants = array();

    /**
     * @var array
     */
    private $contracts = array();

    /**
     * @var FullyQualifiedName
     */
    private $fullyQualifiedName;

    /**
     * @var bool
     */
    private $isAbstract = false;

    /**
     * @var bool
     */
    private $isFinal = false;

    /**
     * @var array
     */
    private $methods = array();

    /**
     * @var Object
     */
    private $parent;

    /**
     * @var array
     */
    private $properties = array();

    /**
     * @var StructurePhpdoc
     */
    private $structurePhpdoc;

    /**
     * @param string $fullyQualifiedName
     *
     * @api
     */
    public function __construct($fullyQualifiedName)
    {
        $this->fullyQualifiedName = new FullyQualifiedName($fullyQualifiedName);
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
        $this->constants[] = $constant;

        return $this;
    }

    /**
     * @return array
     */
    public function allConstants()
    {
        return $this->constants;
    }

    /**
     * @param Contract $contract
     *
     * @return Contract
     *
     * @api
     */
    public function implement(Contract $contract)
    {
        $this->contracts[] = $contract;

        return $this;
    }

    /**
     * @return array
     */
    public function allContracts()
    {
        return $this->contracts;
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
        $this->methods[] = $method;

        return $this;
    }

    /**
     * @return array
     */
    public function allMethods()
    {
        return $this->methods;
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
        $this->properties[] = $property;

        return $this;
    }

    /**
     * @return array
     */
    public function allProperties()
    {
        return $this->properties;
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

    /**
     * @return bool
     */
    public function hasParent()
    {
        return (null !== $this->parent);
    }

    /**
     * @return Object
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Object $parent
     *
     * @return Object
     *
     * @api
     */
    public function extend(Object $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Object
     *
     * @api
     */
    public function removeParent()
    {
        $this->parent = null;
    }

    /**
     * @return bool
     */
    public function isAbstract()
    {
        return $this->isAbstract;
    }

    /**
     * @return Object
     *
     * @api
     */
    public function makeAbstract()
    {
        $this->isAbstract = true;

        return $this;
    }

    /**
     * @return Object
     *
     * @api
     */
    public function removeAbstract()
    {
        $this->isAbstract = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinal()
    {
        return $this->isFinal;
    }

    /**
     * @return Object
     *
     * @api
     */
    public function makeFinal()
    {
        $this->isFinal = true;

        return $this;
    }

    /**
     * @return Object
     *
     * @api
     */
    public function removeFinal()
    {
        $this->isFinal = false;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPhpdoc()
    {
        return $this->structurePhpdoc;
    }

    /**
     * {@inheritDoc}
     */
    public function setPhpdoc(StructurePhpdoc $structurePhpdoc)
    {
        $this->structurePhpdoc = $structurePhpdoc;

        return $this;
    }
}

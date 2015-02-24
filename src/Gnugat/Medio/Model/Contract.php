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
 * A PHP Interface ("interface" is a reserved word and cannot be used as classname).
 *
 * @api
 */
class Contract implements Structure
{
    /**
     * @var Collection
     */
    private $constants;

    /**
     * @var string
     */
    private $fullyQualifiedName;

    /**
     * @var Collection
     */
    private $methods;

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
    }

    /**
     * @param string $fullyQualifiedName
     *
     * @return Contract
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
     * @return Contract
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
     * @return Contract
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

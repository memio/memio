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

use Memio\Memio\Model\Phpdoc\PropertyPhpdoc;

/**
 * @api
 */
class Property
{
    /**
     * @var string
     */
    private $defaultValue;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $visibility = 'private';

    /**
     * @var bool
     */
    private $isStatic = false;

    /**
     * @var PropertyPhpdoc
     */
    private $propertyPhpdoc;

    /**
     * @param string $name
     *
     * @api
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     *
     * @return Property
     *
     * @api
     */
    public static function make($name)
    {
        return new self($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makePrivate()
    {
        $this->visibility = 'private';

        return $this;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makeProtected()
    {
        $this->visibility = 'protected';

        return $this;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makePublic()
    {
        $this->visibility = 'public';

        return $this;
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @return bool
     */
    public function isStatic()
    {
        return $this->isStatic;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makeStatic()
    {
        $this->isStatic = true;

        return $this;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function removeStatic()
    {
        $this->isStatic = false;
    }

    /**
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param string $defaultValue
     *
     * @return Property
     *
     * @api
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * @return PropertyPhpdoc
     */
    public function getPhpdoc()
    {
        return $this->propertyPhpdoc;
    }

    /**
     * @param PropertyPhpdoc $propertyPhpdoc
     *
     * @return Property
     *
     * @api
     */
    public function setPhpdoc(PropertyPhpdoc $propertyPhpdoc)
    {
        $this->propertyPhpdoc = $propertyPhpdoc;

        return $this;
    }
}

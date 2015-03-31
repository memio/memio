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

use Memio\Memio\ValueObject\Type;

/**
 * @api
 */
class Argument
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $defaultValue;

    /**
     * @param string $type
     * @param string $name
     *
     * @api
     */
    public function __construct($type, $name)
    {
        $this->type = new Type($type);
        $this->name = $name;
    }

    /**
     * @param string $type
     * @param string $name
     *
     * @return Argument
     *
     * @api
     */
    public static function make($type, $name)
    {
        return new self($type, $name);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $newName
     */
    public function rename($newName)
    {
        $this->name = $newName;
    }

    /**
     * @return bool
     */
    public function isObject()
    {
        return $this->type->isObject();
    }

    /**
     * @return bool
     */
    public function hasTypeHint()
    {
        return $this->type->hasTypeHint();
    }

    /**
     * @param string $value
     *
     * @return Argument
     *
     * @api
     */
    public function setDefaultValue($value)
    {
        $this->defaultValue = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @return $this
     *
     * @api
     */
    public function removeDefaultValue()
    {
        $this->defaultValue = null;

        return $this;
    }
}

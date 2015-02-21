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

use Gnugat\Medio\ValueObject\Type;

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
     * @param Type   $type
     * @param string $name
     *
     * @api
     */
    public function __construct(Type $type, $name)
    {
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * @param Type   $type
     * @param string $name
     *
     * @return Argument
     *
     * @api
     */
    public static function make(Type $type, $name)
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
}

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

class Argument
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $isObject;

    /**
     * @param string $type
     * @param string $name
     * @param bool   $isObject
     */
    public function __construct($type, $name, $isObject = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->isObject = $isObject;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
        return $this->isObject;
    }
}

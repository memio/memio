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

/**
 * @api
 */
class Type
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     *
     * @api
     */
    public function __construct($name)
    {
        if (!in_array($name, $this->getNonObjectTypes()) && '\\' !== $name[0]) {
            $name = '\\'.$name;
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isObject()
    {
        return !in_array($this->name, $this->getNonObjectTypes());
    }

    /**
     * @return array
     */
    private function getNonObjectTypes()
    {
        return array('string', 'bool', 'int', 'double', 'callable', 'resource', 'array', 'null', 'mixed');
    }

    /**
     * @return bool
     */
    public function hasTypeHint()
    {
        $isCallableFromPhp54 = ('callable' === $this->name && version_compare(PHP_VERSION, '5.4.0') >= 0);

        return ($isCallableFromPhp54 || $this->isObject() || 'array' === $this->name);
    }
}

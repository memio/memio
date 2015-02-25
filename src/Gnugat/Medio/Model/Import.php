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
class Import
{
    /**
     * @var FullyQualifiedName
     */
    private $fullyQualifiedName;

    /**
     * @var string
     */
    private $alias;

    /**
     * @param string $fullyQualifiedName
     */
    public function __construct($fullyQualifiedName)
    {
        $this->fullyQualifiedName = new FullyQualifiedName($fullyQualifiedName);
    }

    /**
     * @param string $fullyQualifiedName
     *
     * @return Import
     *
     * @api
     */
    public static function make($fullyQualifiedName)
    {
        return new self($fullyQualifiedName);
    }

    /**
     * @return string
     */
    public function getFullyQualifiedName()
    {
        return trim($this->fullyQualifiedName->getFullyQualifiedName(), '\\');
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return $this->fullyQualifiedName->getName();
    }

    /**
     * @return bool
     */
    public function hasAlias()
    {
        return (null !== $this->alias);
    }

    /**
     * @param string $alias
     *
     * @return Import
     *
     * @api
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return Import
     *
     * @api
     */
    public function removeAlias()
    {
        $this->alias = null;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
}

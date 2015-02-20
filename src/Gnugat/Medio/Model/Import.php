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

use Gnugat\Medio\ValueObject\FullyQualifiedClassname;

/**
 * @api
 */
class Import
{
    /**
     * @var string
     */
    private $fullyQualifiedClassname;

    /**
     * @var string
     */
    private $alias;

    /**
     * @param string $fullyQualifiedClassname
     */
    public function __construct($fullyQualifiedClassname)
    {
        $this->fullyQualifiedClassname = new FullyQualifiedClassname($fullyQualifiedClassname);
    }

    /**
     * @param string $fullyQualifiedClassname
     *
     * @return Import
     *
     * @api
     */
    public static function make($fullyQualifiedClassname)
    {
        return new self($fullyQualifiedClassname);
    }

    /**
     * @return string
     */
    public function getFqcn()
    {
        return trim($this->fullyQualifiedClassname->getAll(), '\\');
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return $this->fullyQualifiedClassname->getClassname();
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

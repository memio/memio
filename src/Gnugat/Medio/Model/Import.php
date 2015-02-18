<?php

namespace Gnugat\Medio\Model;

/**
 * @api
 */
class Import
{
    /**
     * @var string
     */
    private $fqcn;

    /**
     * @var string
     */
    private $alias;

    /**
     * @param string $fqcn
     */
    public function __construct($fqcn)
    {
        $this->fqcn = $fqcn;
    }

    /**
     * @param string $fqcn
     *
     * @return Import
     *
     * @api
     */
    public static function make($fqcn)
    {
        return new self($fqcn);
    }

    /**
     * @return string
     */
    public function getFqcn()
    {
        return trim($this->fqcn, '\\');
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        $namespaces = explode('\\', $this->fqcn);

        return end($namespaces);
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

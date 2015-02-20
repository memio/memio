<?php

namespace Gnugat\Medio\ValueObject;

/**
 * @api
 */
class FullyQualifiedClassname
{
    /**
     * @var string
     */
    private $all;

    /**
     * @var string
     */
    private $classname;

    /**
     * @var string
     */
    private $namepace_;

    /**
     * @param string $fullyQualifiedClassname
     *
     * @api
     */
    public function __construct($fullyQualifiedClassname)
    {
        $namespaces = explode('\\', $fullyQualifiedClassname);

        $this->classname = array_pop($namespaces);
        $this->namepace_ = implode('\\', $namespaces);
        if ('\\' !== $fullyQualifiedClassname[0]) {
            $fullyQualifiedClassname = '\\'.$fullyQualifiedClassname;
        }
        $this->all = $fullyQualifiedClassname;
    }

    /**
     * @param string $fullyQualifiedClassname
     *
     * @return FullyQualifiedClassname
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
    public function getAll()
    {
        return $this->all;
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return $this->classname;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namepace_;
    }
}

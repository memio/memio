<?php

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
     * @return bool
     */
    public function isObject()
    {
        return $this->isObject;
    }
}

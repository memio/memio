<?php

namespace Gnugat\Medio\Model;

class Type
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
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
}

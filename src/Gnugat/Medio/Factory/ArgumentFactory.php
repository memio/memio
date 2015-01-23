<?php

namespace Gnugat\Medio\Factory;

use Gnugat\Medio\Model\Argument;

class ArgumentFactory
{
    /**
     * @param string $type
     *
     * @return Argument
     */
    public function makeFromType($type)
    {
        $nonObjectTypes = array('array', 'boolean', 'callable', 'double', 'integer', 'NULL', 'resource', 'string');
        if (in_array($type, $nonObjectTypes, true)) {
            return new Argument($type, 'argument');
        }
        if ($type[0] !== '\\') {
            $type = '\\'.$type;
        }
        $nameSpaces = explode('\\', $type);
        $className = end($nameSpaces);
        $name = lcfirst($className);

        return new Argument($type, $name, true);
    }

    /**
     * @param mixed $variable
     *
     * @return Argument
     */
    public function makeFromVariable($variable)
    {
        if (is_object($variable)) {
            return $this->makeFromType(get_class($variable));
        }
        if (is_callable($variable)) {
            return $this->makeFromType('callable');
        }

        return $this->makeFromType(gettype($variable));
    }
}

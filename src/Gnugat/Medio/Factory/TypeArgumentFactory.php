<?php

namespace Gnugat\Medio\Factory;

use Gnugat\Medio\Model\Argument;

class TypeArgumentFactory
{
    /**
     * @param string $type
     *
     * @return Argument
     */
    public function make($type)
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
}

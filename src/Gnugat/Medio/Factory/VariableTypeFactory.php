<?php

namespace Gnugat\Medio\Factory;

use Gnugat\Medio\Model\Type;

class VariableTypeFactory
{
    /**
     * @param mixed $variable
     *
     * @return Type
     */
    public function make($variable)
    {
        if (is_callable($variable)) {
            return new Type('callable');
        }
        if (is_object($variable)) {
            return new Type(get_class($variable));
        }
        $gettypeName = gettype($variable);
        if ($gettypeName === 'boolean') {
            return new Type('bool');
        }
        if ($gettypeName === 'integer') {
            return new Type('int');
        }
        if ($gettypeName === 'NULL') {
            return new Type('null');
        }
        if ($gettypeName === 'unknown type') {
            return new Type('mixed');
        }

        return new Type($gettypeName);
    }
}

<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio;

class Convertor
{
    /**
     * @param string $fullyQualifiedClassname
     *
     * @return string
     */
    public function toNamespace($fullyQualifiedClassname)
    {
        $parts = explode('\\', $fullyQualifiedClassname);
        array_pop($parts);

        return implode('\\', $parts);
    }

    /**
     * @param string $fullyQualifiedClassname
     *
     * @return string
     */
    public function toClassName($fullyQualifiedClassname)
    {
        $parts = explode('\\', $fullyQualifiedClassname);

        return end($parts);
    }

    /**
     * @param string $className
     *
     * @return string
     */
    public function toVariableName($className)
    {
        $className[0] = strtolower($className[0]);

        return $className;
    }
}

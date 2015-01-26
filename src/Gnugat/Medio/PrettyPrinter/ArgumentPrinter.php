<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;

class ArgumentPrinter
{
    /**
     * @param Argument $argument
     *
     * @return string
     */
    public function dump(Argument $argument)
    {
        $type = $argument->getType();
        if ('array' === $type) {
            return 'array $'.$argument->getName();
        }
        if ('callable' === $type && version_compare(PHP_VERSION, '5.4.0') >= 0) {
            return 'callable $'.$argument->getName();
        }
        if (!$argument->isObject()) {
            return '$'.$argument->getName();
        }
        // $nameSpaces = explode('\\', $type);
        // $className = end($nameSpaces);
        $className = $type;

        return $className.' $'.$argument->getName();
    }
}

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

use Gnugat\Medio\Model\Method;

class MethodPhpdocPrinter
{
    /**
     * @param Method $method
     *
     * @return string
     */
    public function dump(Method $method)
    {
        $argumentCollection = $method->getArgumentCollection();
        $arguments = $argumentCollection->all();
        if (empty($arguments)) {
            return '';
        }
        $biggerTypeLength = 0;
        foreach ($arguments as $argument) {
            $biggerTypeLength = max($biggerTypeLength, strlen($argument->getType()));
        }
        $phpDoc = "    /**\n";
        foreach ($arguments as $argument) {
            $type = $argument->getType();
            $spaces = str_repeat(' ', $biggerTypeLength - strlen($type) + 1);
            $phpDoc .= sprintf("     * @param %s%s$%s\n", $type, $spaces, $argument->getName());
        }
        $phpDoc .= '     */';

        return $phpDoc;
    }
}

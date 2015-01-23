<?php

namespace Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;

class ArgumentPrinter
{
    /**
     * @param Argument $argument
     *
     * @return string
     */
    public function format(Argument $argument)
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
        $nameSpaces = explode('\\', $type);
        $className = end($nameSpaces);

        return $className.' $'.$argument->getName();
    }
}

<?php

namespace Gnugat\Medio\Service;

use Gnugat\Medio\Model\Argument;

class ArgumentPrinter
{
    /**
     * {@inheritDoc}
     */
    public function format($model)
    {
        $type = $model->getType();
        if ('array' === $type) {
            return 'array $'.$model->getName();
        }
        if ('callable' === $type && version_compare(PHP_VERSION, '5.4.0') >= 0) {
            return 'callable $'.$model->getName();
        }
        if (!$model->isObject()) {
            return '$'.$model->getName();
        }
        $nameSpaces = explode('\\', $type);
        $className = end($nameSpaces);

        return $className.' $'.$model->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        return $model instanceof Argument;
    }
}

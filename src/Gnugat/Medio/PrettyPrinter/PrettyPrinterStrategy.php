<?php

namespace Gnugat\Medio\PrettyPrinter;

interface PrettyPrinterStrategy
{
    /**
     * @param mixed $model
     *
     * @return bool
     */
    public function supports($model);

    /**
     * @param mixed $model
     * @param array $parameters
     *
     * @return string
     */
    public function generateCode($model, array $parameters = array());
}

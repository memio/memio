<?php

namespace Gnugat\Medio\Service;

use Gnugat\Medio\Model\ArgumentCollection;

class ArgumentCollectionPrinter
{
    /**
     * @var ArgumentPrinter
     */
    private $argumentPrinter;

    /**
     * @param ArgumentPrinter $argumentPrinter
     */
    public function __construct(ArgumentPrinter $argumentPrinter)
    {
        $this->argumentPrinter = $argumentPrinter;
    }

    /**
     * {@inheritDoc}
     */
    public function format($model)
    {
        $printedArguments = array();
        $arguments = $model->all();
        foreach ($arguments as $argument) {
            $printedArguments[] = $this->argumentPrinter->format($argument);
        }

        return implode(', ', $printedArguments);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        return $model instanceof ArgumentCollection;
    }
}

<?php

namespace Gnugat\Medio\PrettyPrinter;

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
     * @param ArgumentCollection $argumentCollection
     *
     * @return string
     */
    public function format(ArgumentCollection $argumentCollection)
    {
        $printedArguments = array();
        $arguments = $argumentCollection->all();
        foreach ($arguments as $argument) {
            $printedArguments[] = $this->argumentPrinter->format($argument);
        }

        return implode(', ', $printedArguments);
    }
}

<?php

namespace Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\ArgumentCollection;
use Gnugat\Medio\PrettyPrinter\ArgumentPrinter;

class MultilineArgumentCollectionFactory
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
    public function dump(ArgumentCollection $argumentCollection)
    {
        $arguments = $argumentCollection->all();
        if (empty($arguments)) {
            return '';
        }
        $printedArguments = array();
        foreach ($arguments as $argument) {
            $printedArguments[] = '        '.$this->argumentPrinter->dump($argument);
        }

        return implode(",\n", $printedArguments)."\n";
    }
}

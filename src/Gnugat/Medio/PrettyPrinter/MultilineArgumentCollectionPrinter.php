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

use Gnugat\Medio\Model\ArgumentCollection;
use Gnugat\Medio\PrettyPrinter\ArgumentPrinter;

/**
 * Generates one argument per line, from an ArgumentCollection.
 *
 * @api
 */
class MultilineArgumentCollectionPrinter
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
            $printedArguments[] = "\n        ".$this->argumentPrinter->dump($argument);
        }

        return implode(',', $printedArguments)."\n    ";
    }
}

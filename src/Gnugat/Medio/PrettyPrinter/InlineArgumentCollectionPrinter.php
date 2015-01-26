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

class InlineArgumentCollectionPrinter
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
        $printedArguments = array();
        $arguments = $argumentCollection->all();
        foreach ($arguments as $argument) {
            $printedArguments[] = $this->argumentPrinter->dump($argument);
        }

        return implode(', ', $printedArguments);
    }
}

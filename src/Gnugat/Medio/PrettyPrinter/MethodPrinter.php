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

class MethodPrinter
{
    /**
     * @var InlineArgumentCollectionPrinter
     */
    private $inlineArgumentCollectionPrinter;

    /**
     * @var MethodPhpdocPrinter
     */
    private $methodPhpdocPrinter;

    /**
     * @var MultilineArgumentCollectionPrinter
     */
    private $multilineArgumentCollectionPrinter;

    /**
     * @param InlineArgumentCollectionPrinter    $inlineArgumentCollectionPrinter
     * @param MethodPhpdocPrinter                $methodPhpdocPrinter
     * @param MultilineArgumentCollectionPrinter $multilineArgumentCollectionPrinter
     */
    public function __construct(
        InlineArgumentCollectionPrinter $inlineArgumentCollectionPrinter,
        MethodPhpdocPrinter $methodPhpdocPrinter,
        MultilineArgumentCollectionPrinter $multilineArgumentCollectionPrinter
    )
    {
        $this->inlineArgumentCollectionPrinter = $inlineArgumentCollectionPrinter;
        $this->methodPhpdocPrinter = $methodPhpdocPrinter;
        $this->multilineArgumentCollectionPrinter = $multilineArgumentCollectionPrinter;
    }

    /**
     * @param Method $method
     *
     * @return string
     */
    public function dump(Method $method)
    {
        $argumentCollection = $method->getArgumentCollection();
        $arguments = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);
        $name = $method->getName();
        $phpdoc = $this->methodPhpdocPrinter->dump($method);
        $phpdoc .= (empty($phpdoc) ? '' : "\n");
        $methodLine = $phpdoc.sprintf('    public function %s(%s)', $name, $arguments);
        if (strlen($methodLine) > 120) {
            $multilineArguments = $this->multilineArgumentCollectionPrinter->dump($argumentCollection);
            $methodLine = $phpdoc.sprintf('    public function %s(%s)', $name, $multilineArguments);
        }

        return <<<EOT
$methodLine
    {
    }
EOT;
    }
}

<?php

namespace Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Method;

class MethodPrinter
{
    /**
     * @var InlineArgumentCollectionPrinter
     */
    private $inlineArgumentCollectionPrinter;

    /**
     * @var MultilineArgumentCollectionPrinter
     */
    private $multilineArgumentCollectionPrinter;

    /**
     * @param InlineArgumentCollectionPrinter    $inlineArgumentCollectionPrinter
     * @param MultilineArgumentCollectionPrinter $multilineArgumentCollectionPrinter
     */
    public function __construct(
        InlineArgumentCollectionPrinter $inlineArgumentCollectionPrinter,
        MultilineArgumentCollectionPrinter $multilineArgumentCollectionPrinter
    )
    {
        $this->inlineArgumentCollectionPrinter = $inlineArgumentCollectionPrinter;
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
        $visibility = $method->getVisibility();
        $visibility .= (empty($visibility) ? '' : ' ');
        $name = $method->getName();
        $methodLine = sprintf('    %sfunction %s(%s)', $visibility, $name, $arguments);
        if (strlen($methodLine) > 120) {
            $multilineArguments = $this->multilineArgumentCollectionPrinter->dump($argumentCollection);
            $methodLine = sprintf('    %sfunction %s(%s)', $visibility, $name, $multilineArguments);
        }

        return <<<EOT
$methodLine
    {
    }
EOT;
    }
}

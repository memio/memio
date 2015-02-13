<?php

namespace Gnugat\Medio\TwigExtension;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\MethodPhpdoc;
use Twig_Extension;
use Twig_SimpleFunction;

class Phpdoc extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('indent_param', array($this, 'indentParam')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'phpdoc';
    }

    /**
     * @param MethodPhpdoc $methodPhpdoc
     * @param Argument     $argument
     *
     * @return string
     */
    public function indentParam(MethodPhpdoc $methodPhpdoc, Argument $argument)
    {
        $arguments = $methodPhpdoc->getParameters();
        $longestType = 0;
        foreach ($methodPhpdoc->getParameters() as $parameter) {
            $longestType = max($longestType, strlen($parameter->getType()));
        }

        return str_repeat(' ', $longestType - strlen($argument->getType()));
    }
}

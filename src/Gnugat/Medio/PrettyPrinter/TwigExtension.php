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
use Twig_Extension;
use Twig_Environment;
use Twig_SimpleFunction;

class TwigExtension extends Twig_Extension
{
    /**
     * @var Twig_Environment
     */
    private $environment;

    /**
     * {@inheritDoc}
     */
    public function initRuntime(Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('should_inline_arguments', array($this, 'shouldInlineArguments')),
            new Twig_SimpleFunction('biggest_type_length', array($this, 'biggestTypeLength')),
            new Twig_SimpleFunction('indent_param', array($this, 'indentParam')),
        );
    }

    /**
     * @param Method $method
     *
     * @return bool
     */
    public function shouldInlineArguments(Method $method)
    {
        $arguments = array();
        foreach ($method->getArgumentCollection()->all() as $argument) {
            $typeHint = $argument->hasTypeHint() ? $argument->getType() : '';
            $variable = '$'.$argument->getName();

            $arguments[] = implode(' ', array($typeHint, $variable));
        }
        $inlineLength = strlen('    public function'.$method->getName().'('.implode(',', $arguments).')');

        return $inlineLength <= 120;
    }

    /**
     * @param array $arguments
     *
     * @return int
     */
    public function biggestTypeLength(array $arguments)
    {
        $biggestTypeLength = 0;
        foreach ($arguments as $argument) {
            $biggestTypeLength = max($biggestTypeLength, strlen($argument->getType()));
        }

        return $biggestTypeLength;
    }

    /**
     * @param string $type
     * @param int    $biggestTypeLength
     *
     * @return string
     */
    public function indentParam($type, $biggestTypeLength)
    {
        return str_repeat(' ', $biggestTypeLength - strlen($type));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'argument';
    }
}

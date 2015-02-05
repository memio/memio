<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\PrettyPrinter\Twig;

use Gnugat\Medio\Model\Method;

class ArgumentExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * {@inheritDoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('should_inline_arguments', array($this, 'shouldInlineArguments')),
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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'argument';
    }
}

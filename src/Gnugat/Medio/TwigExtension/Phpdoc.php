<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
            new Twig_SimpleFunction('make_phpdoc', array($this, 'makePhpdoc')),
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
        $longestType = 0;
        foreach ($methodPhpdoc->getParameters() as $parameter) {
            $longestType = max($longestType, strlen($parameter->getType()));
        }

        return str_repeat(' ', $longestType - strlen($argument->getType()));
    }


    /**
     * @param mixed $model
     *
     * @return string
     */
    public function makePhpdoc($model)
    {
        $className = get_class($model).'Phpdoc';

        return new $className($model);
    }
}

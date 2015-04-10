<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\TwigExtension;

use Memio\Model\Argument;
use Memio\Model\Contract;
use Memio\Model\Type as ModelType;
use Twig_Extension;
use Twig_SimpleTest;
use Twig_SimpleFunction;

class Type extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getTests()
    {
        return array(
            new Twig_SimpleTest('contract', array($this, 'isContract')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('has_typehint', array($this, 'hasTypehint')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'type';
    }

    /**
     * @param mixed $model
     *
     * @return bool
     */
    public function isContract($model)
    {
        return $model instanceof Contract;
    }

    /**
     * @param mixed $model
     *
     * @return bool
     */
    public function hasTypehint($model)
    {
        if (!$model instanceof Argument) {
            return false;
        }
        $type = new ModelType($model->getType());

        return $type->hasTypehint();
    }
}

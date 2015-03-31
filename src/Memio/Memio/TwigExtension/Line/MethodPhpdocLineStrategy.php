<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\TwigExtension\Line;

use Memio\Memio\Model\Phpdoc\MethodPhpdoc;

class MethodPhpdocLineStrategy implements LineStrategy
{
    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        return $model instanceof MethodPhpdoc;
    }

    /**
     * {@inheritDoc}
     */
    public function needsLineAfter($model, $block)
    {
        $parameterTags = $model->getParameterTags();

        $hasApiTag = (null !== $model->getApiTag());
        $hasParameterTags = (!empty($parameterTags));
        $hasDescription = (null !== $model->getDescription());
        $hasDeprecationTag = (null !== $model->getDeprecationTag());
        if ('description' === $block) {
            return ($hasDescription && ($hasParameterTags || $hasApiTag || $hasDeprecationTag));
        }
        if ('parameter_tags' === $block) {
            return ($hasParameterTags && ($hasApiTag || $hasDeprecationTag));
        }
        if ('deprecation_tag' === $block) {
            return ($hasApiTag && $hasDeprecationTag);
        }
    }
}

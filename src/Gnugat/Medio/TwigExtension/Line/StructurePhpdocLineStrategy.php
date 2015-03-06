<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\TwigExtension\Line;

use Gnugat\Medio\Model\Phpdoc\StructurePhpdoc;

class StructurePhpdocLineStrategy implements LineStrategy
{
    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        return $model instanceof StructurePhpdoc;
    }

    /**
     * {@inheritDoc}
     */
    public function needsLineAfter($model, $block)
    {
        $hasDescription = (null !== $model->getDescription());
        $hasApiTag = (null !== $model->getApiTag());
        $hasDeprecationTag = (null !== $model->getDeprecationTag());
        if ('description' === $block) {
            return ($hasDescription && ($hasApiTag || $hasDeprecationTag));
        }
        if ('deprecation_tag' === $block) {
            return ($hasApiTag && $hasDeprecationTag);
        }
    }
}

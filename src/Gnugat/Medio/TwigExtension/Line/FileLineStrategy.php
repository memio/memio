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

use Gnugat\Medio\Exception\InvalidArgumentException;
use Gnugat\Medio\Model\File;

class FileLineStrategy implements LineStrategy
{
    /**
     * {@inheritdDoc}
     */
    public function supports($model)
    {
        return $model instanceof File;
    }

    /**
     * {@inheritdDoc}
     */
    public function needsLineAfter($model, $block)
    {
        $imports = $model->getImportCollection()->all();
        if ('imports' === $block) {
            return (!empty($imports));
        }
        $constants = $model->getConstantCollection()->all();
        $properties = $model->getPropertyCollection()->all();
        $methods = $model->getMethodCollection()->all();
        if ('constants' === $block) {
            return (!empty($constants) && (!empty($properties) || !empty($methods)));
        }
        if ('properties' === $block) {
            return (!empty($properties) && !empty($methods));
        }

        throw new InvalidArgumentException('The function needs_line_after does not support given "'.$block.'"');
    }
}

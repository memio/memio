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
use Gnugat\Medio\Model\Contract;

class ContractLineStrategy implements LineStrategy
{
    /**
     * {@inheritdDoc}
     */
    public function supports($model)
    {
        return $model instanceof Contract;
    }

    /**
     * {@inheritdDoc}
     */
    public function needsLineAfter($model, $block)
    {
        $constants = $model->allConstants();
        $methods = $model->allMethods();
        if ('constants' === $block) {
            return (!empty($constants) && !empty($methods));
        }

        throw new InvalidArgumentException('The function needs_line_after does not support given "'.$block.'"');
    }
}

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

class Line
{
    /**
     * @var array
     */
    private $strategies = array();

    /**
     * @param LineStrategy $lineStrategy
     */
    public function add(LineStrategy $lineStrategy)
    {
        $this->strategies[] = $lineStrategy;
    }

    /**
     * @param mixed  $model
     * @param string $block
     *
     * @throws InvalidArgumentException If no strategy supports the given model
     */
    public function needsLineAfter($model, $block)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($model)) {
                return $strategy->needsLineAfter($model, $block);
            }
        }

        throw new InvalidArgumentException('No strategy supports given model');
    }
}

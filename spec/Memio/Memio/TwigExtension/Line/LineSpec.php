<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\TwigExtension\Line;

use Memio\Memio\Model\Argument;
use Memio\Memio\TwigExtension\Line\LineStrategy;
use PhpSpec\ObjectBehavior;

class LineSpec extends ObjectBehavior
{
    const BLOCK = 'constants';
    const STRATEGY_RETURN = true;

    function let(LineStrategy $lineStrategy)
    {
        $this->add($lineStrategy);
    }

    function it_executes_the_first_strategy_that_supports_given_model(Argument $model, LineStrategy $lineStrategy)
    {
        $lineStrategy->supports($model)->willReturn(true);
        $lineStrategy->needsLineAfter($model, self::BLOCK)->willReturn(self::STRATEGY_RETURN);

        $this->needsLineAfter($model, self::BLOCK)->shouldBe(self::STRATEGY_RETURN);
    }

    function it_fails_when_no_strategy_supports_given_model(Argument $model, LineStrategy $lineStrategy)
    {
        $exception = 'Memio\\Memio\\Exception\\InvalidArgumentException';

        $lineStrategy->supports($model)->willReturn(false);

        $this->shouldThrow($exception)->duringNeedsLineAfter($model, self::BLOCK);
    }
}

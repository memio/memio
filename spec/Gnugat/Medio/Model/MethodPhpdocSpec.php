<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\ArgumentCollection;
use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodPhpdocSpec extends ObjectBehavior
{
    function let(Method $method)
    {
        $this->beConstructedWith($method);
    }

    function it_can_be_empty(ArgumentCollection $argumentCollection, Method $method)
    {
        $method->getArgumentCollection()->willReturn($argumentCollection);
        $argumentCollection->all()->willReturn(array());

        $this->isEmpty()->shouldBe(true);
    }

    function it_has_parameters(Argument $argument, ArgumentCollection $argumentCollection, Method $method)
    {
        $arguments = array($argument);
        $method->getArgumentCollection()->willReturn($argumentCollection);
        $argumentCollection->all()->willReturn($arguments);

        $this->getParameters()->shouldBe($arguments);
        $this->isEmpty()->shouldBe(false);
    }
}

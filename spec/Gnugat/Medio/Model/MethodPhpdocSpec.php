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
use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodPhpdocSpec extends ObjectBehavior
{
    function let(Method $method)
    {
        $this->beConstructedWith($method);
    }

    function it_can_be_empty(Method $method)
    {
        $method->allArguments()->willReturn(array());

        $this->isEmpty()->shouldBe(true);
    }

    function it_has_parameters(Argument $argument, Method $method)
    {
        $method->allArguments()->willReturn(array($argument));

        $this->getParameters()->shouldBe(array($argument));
        $this->isEmpty()->shouldBe(false);
    }
}

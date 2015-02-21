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
use Gnugat\Medio\ValueObject\Collection;
use PhpSpec\ObjectBehavior;

class MethodPhpdocSpec extends ObjectBehavior
{
    function let(Method $method)
    {
        $this->beConstructedWith($method);
    }

    function it_can_be_empty(Collection $arguments, Method $method)
    {
        $method->getArgumentCollection()->willReturn($arguments);
        $arguments->all()->willReturn(array());

        $this->isEmpty()->shouldBe(true);
    }

    function it_has_parameters(Argument $argument, Collection $arguments, Method $method)
    {
        $rawArguments = array($argument);
        $method->getArgumentCollection()->willReturn($arguments);
        $arguments->all()->willReturn($rawArguments);

        $this->getParameters()->shouldBe($rawArguments);
        $this->isEmpty()->shouldBe(false);
    }
}

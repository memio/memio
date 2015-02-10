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

use Gnugat\Medio\Model\Type;
use PhpSpec\ObjectBehavior;

class ArgumentSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Type('array'), 'lines');
    }

    function it_has_a_type()
    {
        $this->getType()->shouldBe('array');
    }

    function it_can_have_a_type_hint(Type $type)
    {
        $this->beConstructedWith($type, 'name');

        $type->hasTypeHint()->shouldBeCalled();

        $this->hasTypeHint();
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe('lines');
    }

    function it_can_be_renamed()
    {
        $this->rename('lineCollection');
        $this->getName()->shouldBe('lineCollection');
    }

    function it_can_be_an_object(Type $type)
    {
        $this->beConstructedWith($type, 'name');

        $type->isObject()->shouldBeCalled();

        $this->isObject();
    }
}

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

use PhpSpec\ObjectBehavior;

class ArgumentSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('array', 'lines');
    }

    function it_has_a_type()
    {
        $this->getType()->shouldBe('array');
    }

    function it_can_have_a_type_hint()
    {
        $this->hasTypeHint()->shouldBe(true);
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

    function it_can_be_an_object()
    {
        $this->beConstructedWith('DateTime', 'name');

        $this->isObject()->shouldBe(true);
    }

    function it_can_be_have_default_value()
    {
        $this->getDefaultValue()->shouldBe(null);

        $this->setDefaultValue('null');
        $this->getDefaultValue()->shouldBe('null');

        $this->removeDefaultValue();
        $this->getDefaultValue()->shouldBe(null);
    }
}

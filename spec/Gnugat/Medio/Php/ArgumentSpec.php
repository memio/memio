<?php

namespace spec\Gnugat\Medio\Php;

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

    function it_has_a_name()
    {
        $this->getName()->shouldBe('lines');
    }
}

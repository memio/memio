<?php

namespace spec\Gnugat\Medio\Model;

use PhpSpec\ObjectBehavior;

class BodySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array());
    }

    function it_has_lines()
    {
        $this->getLines()->shouldBe(array());
    }
}

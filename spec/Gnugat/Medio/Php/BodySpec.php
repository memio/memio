<?php

namespace spec\Gnugat\Medio\Php;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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

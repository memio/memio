<?php

namespace spec\Gnugat\Medio\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConstantSpec extends ObjectBehavior
{
    const NAME = 'MY_CONSTANT';
    const VALUE = 0;

    function let()
    {
        $this->beConstructedWith(self::NAME, self::VALUE);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe(self::NAME);
    }

    function it_has_a_value()
    {
        $this->getValue()->shouldBe(self::VALUE);
    }
}

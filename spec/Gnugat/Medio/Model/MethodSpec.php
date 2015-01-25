<?php

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\ArgumentCollection;
use PhpSpec\ObjectBehavior;

class MethodSpec extends ObjectBehavior
{
    const NAME = '__construct';
    const VISIBILITY = 'public';

    private $argumentCollection;

    function let()
    {
        $this->argumentCollection = new ArgumentCollection();

        $this->beConstructedWith($this->argumentCollection, self::NAME, self::VISIBILITY);
    }

    function it_has_argument_collection()
    {
        $this->getArgumentCollection()->shouldBe($this->argumentCollection);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe(self::NAME);
    }

    function it_has_a_visibility()
    {
        $this->getVisibility()->shouldBe(self::VISIBILITY);
    }
}

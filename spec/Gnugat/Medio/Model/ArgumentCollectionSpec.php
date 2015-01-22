<?php

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;

class ArgumentCollectionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array());
    }

    function it_has_arguments()
    {
        $this->getArguments()->shouldHaveCount(0);
    }

    function it_can_get_more_arguments()
    {
        $this->add(new Argument('array', 'lines'));
        $this->add(new Argument('string', 'content'));

        $this->getArguments()->shouldHaveCount(2);
    }
}

<?php

namespace spec\Gnugat\Medio\Service;

use PhpSpec\ObjectBehavior;

class ArgumentFactorySpec extends ObjectBehavior
{
    function it_names_objects_after_their_type()
    {
        $argument = $this->makeFromType('Gnugat\Medio\Service\ArgumentFactory');

        $argument->getName()->shouldBe('argumentFactory');
        $argument->isObject()->shouldBe(true);
    }

    function it_gives_generic_name_to_non_objects()
    {
        $argument = $this->makeFromType('string');

        $argument->getName()->shouldBe('argument');
        $argument->isObject()->shouldBe(false);
    }

    function it_makes_object_from_variable()
    {
        $variable = new \ArrayObject();

        $argument = $this->makeFromVariable($variable);
        $argument->getName()->shouldBe('arrayObject');
        $argument->isObject()->shouldBe(true);
        $argument->getType()->shouldBe('\\ArrayObject');
    }

    function it_makes_non_object_from_variable()
    {
        $variable = 'Nobody expects the Spanish Inquisition!';

        $argument = $this->makeFromVariable($variable);
        $argument->getName()->shouldBe('argument');
        $argument->isObject()->shouldBe(false);
        $argument->getType()->shouldBe('string');
    }
}

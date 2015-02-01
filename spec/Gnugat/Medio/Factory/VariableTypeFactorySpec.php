<?php

namespace spec\Gnugat\Medio\Factory;

use PhpSpec\ObjectBehavior;

class VariableTypeFactorySpec extends ObjectBehavior
{
    function it_makes_an_object_from_variable()
    {
        $object = new \DateTime();

        $type = $this->make($object);

        $type->getName()->shouldBe('\DateTime');
        $type->isObject()->shouldBe(true);
    }

    function it_makes_an_array_from_variable()
    {
        $array = array();

        $type = $this->make($array);

        $type->getName()->shouldBe('array');
        $type->isObject()->shouldBe(false);
    }

    function it_makes_a_callable_from_variable()
    {
        $callable = function() {};

        $type = $this->make($callable);

        $type->getName()->shouldBe('callable');
        $type->isObject()->shouldBe(false);
    }

    function it_makes_a_string_from_variable()
    {
        $string = 'Nobody expects the spanish inquisition!';

        $type = $this->make($string);

        $type->getName()->shouldBe('string');
        $type->isObject()->shouldBe(false);
    }

    function it_makes_a_boolean_from_variable()
    {
        $boolean = true;

        $type = $this->make($boolean);

        $type->getName()->shouldBe('bool');
        $type->isObject()->shouldBe(false);
    }

    function it_makes_a_resource_from_variable()
    {
        $resource = fopen('/dev/null', 'r');

        $type = $this->make($resource);
        fclose($resource);

        $type->getName()->shouldBe('resource');
        $type->isObject()->shouldBe(false);
    }

    function it_makes_an_integer_from_variable()
    {
        $integer = 42;

        $type = $this->make($integer);

        $type->getName()->shouldBe('int');
        $type->isObject()->shouldBe(false);
    }

    function it_makes_a_double_from_variable()
    {
        $double = 3.14;

        $type = $this->make($double);

        $type->getName()->shouldBe('double');
        $type->isObject()->shouldBe(false);
    }

    function it_makes_null_from_variable()
    {
        $null = null;

        $type = $this->make($null);

        $type->getName()->shouldBe('null');
        $type->isObject()->shouldBe(false);
    }
}

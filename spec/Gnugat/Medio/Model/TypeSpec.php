<?php

namespace spec\Gnugat\Medio\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TypeSpec extends ObjectBehavior
{
    function it_can_be_an_object()
    {
        $this->beConstructedWith('\DateTime');

        $this->getName()->shouldBe('\DateTime');
        $this->isObject()->shouldBe(true);
    }

    function it_preffix_object_types_by_namespace_separator()
    {
        $this->beConstructedWith('DateTime');

        $this->getName()->shouldBe('\DateTime');
        $this->isObject()->shouldBe(true);
    }

    function it_can_be_an_array()
    {
        $this->beConstructedWith('array');

        $this->getName()->shouldBe('array');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_a_callable()
    {
        $this->beConstructedWith('callable');

        $this->getName()->shouldBe('callable');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_a_string()
    {
        $this->beConstructedWith('string');

        $this->getName()->shouldBe('string');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_a_boolean()
    {
        $this->beConstructedWith('bool');

        $this->getName()->shouldBe('bool');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_a_resource()
    {
        $this->beConstructedWith('resource');

        $this->getName()->shouldBe('resource');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_an_integer()
    {
        $this->beConstructedWith('int');

        $this->getName()->shouldBe('int');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_a_double()
    {
        $this->beConstructedWith('double');

        $this->getName()->shouldBe('double');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_null()
    {
        $this->beConstructedWith('null');

        $this->getName()->shouldBe('null');
        $this->isObject()->shouldBe(false);
    }

    function it_can_be_unknown()
    {
        $this->beConstructedWith('mixed');

        $this->getName()->shouldBe('mixed');
        $this->isObject()->shouldBe(false);
    }
}

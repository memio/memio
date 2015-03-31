<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\ValueObject;

use PhpSpec\ObjectBehavior;

class TypeSpec extends ObjectBehavior
{
    function it_can_be_an_object()
    {
        $this->beConstructedWith('Memio\Memio\MyClass');

        $this->getName()->shouldBe('MyClass');
        $this->isObject()->shouldBe(true);
        $this->getFullyQualifiedName()->shouldBe('Memio\Memio\MyClass');
    }

    function it_can_have_a_type_hint_if_it_is_an_object()
    {
        $this->beConstructedWith('DateTime');

        $this->hasTypeHint()->shouldBe(true);
    }

    function it_can_have_a_type_hint_if_it_is_an_array()
    {
        $this->beConstructedWith('array');

        $this->hasTypeHint()->shouldBe(true);
    }

    function it_can_have_a_type_hint_if_it_is_a_callable_from_php_5_4()
    {
        $this->beConstructedWith('callable');

        $this->hasTypeHint()->shouldBe(version_compare(PHP_VERSION, '5.4.0') >= 0);
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

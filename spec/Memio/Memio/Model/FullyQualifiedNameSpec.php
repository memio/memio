<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\Model;

use PhpSpec\ObjectBehavior;

class FullyQualifiedNameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Memio\\Memio\\MyClass');
    }

    function it_has_fully_qualified_classname()
    {
        $this->getFullyQualifiedName()->shouldBe('Memio\\Memio\\MyClass');
    }

    function it_has_name()
    {
        $this->getName()->shouldBe('MyClass');
    }

    function it_has_namespace()
    {
        $this->getNamespace()->shouldBe('Memio\\Memio');
    }

    function it_can_have_an_alias()
    {
        $this->hasAlias()->shouldBe(false);
        $this->getName()->shouldBe('MyClass');

        $this->setAlias('MyAlias');
        $this->hasAlias()->shouldBe(true);
        $this->getName()->shouldBe('MyAlias');

        $this->removeAlias();
        $this->hasAlias()->shouldBe(false);
        $this->getName()->shouldBe('MyClass');
    }
}

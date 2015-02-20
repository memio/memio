<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\ValueObject;

use PhpSpec\ObjectBehavior;

class FullyQualifiedClassnameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Gnugat\\Medio\\MyClass');
    }

    function it_has_fully_qualified_classname()
    {
        $this->getAll()->shouldBe('\\Gnugat\\Medio\\MyClass');
    }

    function it_has_classname()
    {
        $this->getClassname()->shouldBe('MyClass');
    }

    function it_has_namespace()
    {
        $this->getNamespace()->shouldBe('Gnugat\\Medio');
    }
}

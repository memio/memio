<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model\Phpdoc;

use PhpSpec\ObjectBehavior;

class ParameterTagSpec extends ObjectBehavior
{
    function it_has_a_type_and_a_name()
    {
        $this->beConstructedWith('Gnugat\Medio\MyClass', 'myClass');

        $this->getType()->shouldBe('MyClass');
        $this->getName()->shouldBe('myClass');
    }

    function it_can_have_a_description()
    {
        $this->beConstructedWith('Gnugat\Medio\MyClass', 'myClass', 'description');

        $this->getType()->shouldBe('MyClass');
        $this->getName()->shouldBe('myClass');
        $this->getDescription()->shouldBe('description');
    }
}

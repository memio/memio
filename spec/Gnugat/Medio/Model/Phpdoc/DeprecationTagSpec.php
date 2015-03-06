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
use Prophecy\Argument;

class DeprecationTagSpec extends ObjectBehavior
{
    function it_can_be_just_a_tag()
    {
        $this->getVersion()->shouldBe(null);
        $this->getDescription()->shouldBe(null);
    }

    function it_can_have_a_version()
    {
        $this->beConstructedWith('v2.1');

        $this->getVersion()->shouldBe('v2.1');
        $this->getDescription()->shouldBe(null);
    }

    function it_can_have_a_description()
    {
        $this->beConstructedWith('v2.1', 'Use Object#myMethod instead');

        $this->getVersion()->shouldBe('v2.1');
        $this->getDescription()->shouldBe('Use Object#myMethod instead');
    }
}

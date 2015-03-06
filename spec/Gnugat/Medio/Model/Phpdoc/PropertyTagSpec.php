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

class PropertyTagSpec extends ObjectBehavior
{
    function it_has_a_type()
    {
        $this->beConstructedWith('string');

        $this->getType()->shouldBe('string');
    }
}

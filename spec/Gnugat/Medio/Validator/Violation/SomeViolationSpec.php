<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Validator\Violation;

use PhpSpec\ObjectBehavior;

class SomeViolationSpec extends ObjectBehavior
{
    const MESSAGE = 'Model is invalid';

    function let()
    {
        $this->beConstructedWith(self::MESSAGE);
    }

    function it_is_a_violation()
    {
        $this->shouldHaveType('Gnugat\Medio\Validator\Violation');
    }

    function it_has_a_message()
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }
}

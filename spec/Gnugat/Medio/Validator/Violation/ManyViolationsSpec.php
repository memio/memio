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

use Gnugat\Medio\Validator\Violation\SomeViolation;
use PhpSpec\ObjectBehavior;

class ManyViolationsSpec extends ObjectBehavior
{
    const FIRST_MESSAGE = 'Model is invalid';
    const SECOND_MESSAGE = 'Model is wrong';

    function it_is_a_violation()
    {
        $this->shouldHaveType('Gnugat\Medio\Validator\Violation');
    }

    function it_can_have_no_violations()
    {
        $this->get()->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
        $this->getMessage()->shouldBe('');
    }

    function it_can_have_one_violation(SomeViolation $someViolation)
    {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);

        $this->add($someViolation);

        $this->get()->shouldHaveType('Gnugat\Medio\Validator\Violation\SomeViolation');
        $this->getMessage()->shouldBe(self::FIRST_MESSAGE);
    }

    function it_can_have_many_violations(SomeViolation $someViolation, SomeViolation $someOtherViolation)
    {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);
        $someOtherViolation->getMessage()->willReturn(self::SECOND_MESSAGE);

        $this->add($someViolation);
        $this->add($someOtherViolation);

        $this->get()->shouldHaveType('Gnugat\Medio\Validator\Violation\ManyViolations');
        $this->getMessage()->shouldBe(self::FIRST_MESSAGE."\n".self::SECOND_MESSAGE);
    }
}

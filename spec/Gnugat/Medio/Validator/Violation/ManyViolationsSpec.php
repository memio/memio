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

use Gnugat\Medio\Validator\Violation\OneViolation;
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
        $this->get()->shouldHaveType('Gnugat\Medio\Validator\Violation\NoViolation');
        $this->getMessage()->shouldBe('');
    }

    function it_can_have_one_violation(OneViolation $oneViolation)
    {
        $oneViolation->getMessage()->willReturn(self::FIRST_MESSAGE);

        $this->add($oneViolation);

        $this->get()->shouldHaveType('Gnugat\Medio\Validator\Violation\OneViolation');
        $this->getMessage()->shouldBe(self::FIRST_MESSAGE);
    }

    function it_can_have_many_violations(OneViolation $oneViolation, OneViolation $anotherViolation)
    {
        $oneViolation->getMessage()->willReturn(self::FIRST_MESSAGE);
        $anotherViolation->getMessage()->willReturn(self::SECOND_MESSAGE);

        $this->add($oneViolation);
        $this->add($anotherViolation);

        $this->get()->shouldHaveType('Gnugat\Medio\Validator\Violation\ManyViolations');
        $this->getMessage()->shouldBe(self::FIRST_MESSAGE."\n".self::SECOND_MESSAGE);
    }
}

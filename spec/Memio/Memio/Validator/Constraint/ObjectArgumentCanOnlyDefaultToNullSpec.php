<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\Validator\Constraint;

use Memio\Model\Argument;
use Memio\Model\Constant;
use Memio\Model\Method;
use Memio\Model\Property;
use PhpSpec\ObjectBehavior;

class ObjectArgumentCanOnlyDefaultToNullSpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Memio\Memio\Validator\Constraint');
    }

    function it_is_fine_with_scalar_arguments(Argument $argument)
    {
        $argument->getType()->willReturn('string');
        $argument->getDefaultValue()->willReturn(null);

        $this->validate($argument)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_fine_with_object_argument_without_default_value(Argument $argument)
    {
        $argument->getType()->willReturn('DateTime');
        $argument->getDefaultValue()->willReturn(null);

        $this->validate($argument)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_fine_with_object_argument_defaulting_to_null(Argument $argument)
    {
        $argument->getType()->willReturn('DateTime');
        $argument->getDefaultValue()->willReturn('null');

        $this->validate($argument)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_object_argument_not_defaulting_to_null(Argument $argument)
    {
        $argument->getType()->willReturn('DateTime');
        $argument->getDefaultValue()->willReturn('""');
        $argument->getName()->willReturn('objectArgument');

        $this->validate($argument)->shouldHaveType('Memio\Memio\Validator\Violation\SomeViolation');
    }
}

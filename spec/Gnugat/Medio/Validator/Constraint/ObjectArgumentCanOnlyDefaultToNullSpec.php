<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Validator\Constraint;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Constant;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Property;
use PhpSpec\ObjectBehavior;

class ObjectArgumentCanOnlyDefaultToNullSpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\Constraint');
    }

    function it_is_fine_with_scalar_arguments(Argument $argument)
    {
        $argument->isObject()->willReturn(false);
        $argument->getDefaultValue()->willReturn(null);

        $this->validate($argument)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_fine_with_object_argument_without_default_value(Argument $argument)
    {
        $argument->isObject()->willReturn(true);
        $argument->getDefaultValue()->willReturn(null);

        $this->validate($argument)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_fine_with_object_argument_defaulting_to_null(Argument $argument)
    {
        $argument->isObject()->willReturn(true);
        $argument->getDefaultValue()->willReturn('null');

        $this->validate($argument)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_object_argument_not_defaulting_to_null(Argument $argument)
    {
        $argument->isObject()->willReturn(true);
        $argument->getDefaultValue()->willReturn('""');
        $argument->getName()->willReturn('objectArgument');

        $this->validate($argument)->shouldHaveType('Gnugat\Medio\Validator\Violation\SomeViolation');
    }
}

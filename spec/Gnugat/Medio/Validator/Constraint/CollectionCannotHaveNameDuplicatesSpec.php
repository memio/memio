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

class CollectionCannotHaveNameDuplicatesSpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\Constraint');
    }

    function it_is_fine_with_unique_names(Argument $argument1, Argument $argument2)
    {
        $argument1->getName()->willReturn('myArgument1');
        $argument2->getName()->willReturn('myArgument2');

        $this->validate(array($argument1, $argument2))->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_name_duplicates(Argument $argument1, Argument $argument2)
    {
        $argument1->getName()->willReturn('myArgument');
        $argument2->getName()->willReturn('myArgument');

        $this->validate(array($argument1, $argument2))->shouldHaveType('Gnugat\Medio\Validator\Violation\SomeViolation');
    }
}

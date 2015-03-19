<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Validator;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Exception\ConstraintFailedException;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\Violation\NoneViolation;
use Gnugat\Medio\Validator\Violation\SomeViolation;
use Gnugat\Medio\Validator\Violation\ManyViolations;
use PhpSpec\ObjectBehavior;

class ConstraintValidatorSpec extends ObjectBehavior
{
    const FIRST_VIOLATION = 'Model is invalid';
    const SECOND_VIOLATION = 'Model is even more invalid';

    function let(Constraint $firstConstraint, Constraint $secondConstraint)
    {
        $this->add($firstConstraint);
        $this->add($secondConstraint);
    }

    function it_returns_no_violations_if_model_is_fine(
        Argument $model,
        Constraint $firstConstraint,
        Constraint $secondConstraint,
        NoneViolation $noneViolation1,
        NoneViolation $noneViolation2
    )
    {
        $firstConstraint->validate($model)->willReturn($noneViolation1);
        $secondConstraint->validate($model)->willReturn($noneViolation2);

        $this->validate($model)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_returns_one_violation_if_one_constraint_failed(
        Argument $model,
        Constraint $firstConstraint,
        Constraint $secondConstraint,
        NoneViolation $noneViolation,
        SomeViolation $someViolation
    )
    {
        $firstConstraint->validate($model)->willReturn($noneViolation);
        $secondConstraint->validate($model)->willReturn($someViolation);

        $this->validate($model)->shouldHaveType('Gnugat\Medio\Validator\Violation\SomeViolation');
    }

    function it_returns_many_violations_if_many_constraints_failed(
        Argument $model,
        Constraint $firstConstraint,
        Constraint $secondConstraint,
        SomeViolation $someViolation1,
        SomeViolation $someViolation2
    )
    {
        $firstConstraint->validate($model)->willReturn($someViolation1);
        $secondConstraint->validate($model)->willReturn($someViolation2);

        $this->validate($model)->shouldHaveType('Gnugat\Medio\Validator\Violation\ManyViolations');
    }
}

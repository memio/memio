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
use Gnugat\Medio\Validator\Violation\NoViolation;
use Gnugat\Medio\Validator\Violation\OneViolation;
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
        NoViolation $noViolation1,
        NoViolation $noViolation2
    )
    {
        $firstConstraint->validate($model)->willReturn($noViolation1);
        $secondConstraint->validate($model)->willReturn($noViolation2);

        $this->validate($model)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoViolation');
    }

    function it_returns_one_violation_if_one_constraint_failed(
        Argument $model,
        Constraint $firstConstraint,
        Constraint $secondConstraint,
        NoViolation $noViolation,
        OneViolation $oneViolation
    )
    {
        $firstConstraint->validate($model)->willReturn($noViolation);
        $secondConstraint->validate($model)->willReturn($oneViolation);

        $this->validate($model)->shouldHaveType('Gnugat\Medio\Validator\Violation\OneViolation');
    }

    function it_returns_many_violations_if_many_constraints_failed(
        Argument $model,
        Constraint $firstConstraint,
        Constraint $secondConstraint,
        OneViolation $oneViolation1,
        OneViolation $oneViolation2
    )
    {
        $firstConstraint->validate($model)->willReturn($oneViolation1);
        $secondConstraint->validate($model)->willReturn($oneViolation2);

        $this->validate($model)->shouldHaveType('Gnugat\Medio\Validator\Violation\ManyViolations');
    }
}

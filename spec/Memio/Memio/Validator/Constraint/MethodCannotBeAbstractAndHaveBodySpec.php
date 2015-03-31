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

use Memio\Memio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodCannotBeAbstractAndHaveBodySpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Memio\Memio\Validator\Constraint');
    }

    function it_is_fine_with_simple_methods(Method $method)
    {
        $method->isAbstract()->willReturn(false);
        $method->getBody()->willReturn('');

        $this->validate($method)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_fine_with_abstract_methods(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->getBody()->willReturn(null);

        $this->validate($method)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_abstract_methods_with_body(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->getBody()->willReturn('');
        $method->getName()->willReturn('__construct');

        $this->validate($method)->shouldHaveType('Memio\Memio\Validator\Violation\SomeViolation');
    }
}

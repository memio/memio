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

use Memio\Model\Contract;
use Memio\Model\Method;
use PhpSpec\ObjectBehavior;

class ContractMethodsCannotBeFinalSpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Memio\Memio\Validator\Constraint');
    }

    function it_is_fine_with_simple_methods(Contract $contract, Method $method)
    {
        $contract->getName()->willReturn('HttpKernelInterface');
        $contract->allMethods()->willReturn(array($method));
        $method->isFinal()->willReturn(false);

        $this->validate($contract)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_protected_methods(Contract $contract, Method $method)
    {
        $contract->getName()->willReturn('HttpKernelInterface');
        $contract->allMethods()->willReturn(array($method));
        $method->isFinal()->willReturn(true);
        $method->getName()->willReturn('handle');

        $this->validate($contract)->shouldHaveType('Memio\Memio\Validator\Violation\SomeViolation');
    }
}

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

use Memio\Memio\Model\Contract;
use Memio\Memio\Model\Method;
use PhpSpec\ObjectBehavior;

class ContractMethodsCannotHaveBodySpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Memio\Memio\Validator\Constraint');
    }

    function it_is_fine_with_pure_virtual_methods(Contract $contract, Method $method)
    {
        $contract->getName()->willReturn('HttpKernelInterface');
        $contract->allMethods()->willReturn(array($method));
        $method->getBody()->willReturn(null);

        $this->validate($contract)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_none_pure_virtual_methods(Contract $contract, Method $method)
    {
        $contract->getName()->willReturn('HttpKernelInterface');
        $contract->allMethods()->willReturn(array($method));
        $method->getBody()->willReturn('echo "Nobody expects the spanish inquisition";');
        $method->getName()->willReturn('handle');

        $this->validate($contract)->shouldHaveType('Memio\Memio\Validator\Violation\SomeViolation');
    }
}

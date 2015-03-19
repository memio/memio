<?php

namespace spec\Gnugat\Medio\Validator\Constraint;

use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodCannotBeBothAbstractAndFinalSpec extends ObjectBehavior
{
    function it_is_a_cosntraint()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\Constraint');
    }

    function it_is_fine_with_simple_methods(Method $method)
    {
        $method->isAbstract()->willReturn(false);
        $method->isFinal()->willReturn(false);

        $this->validate($method)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_fine_with_abstract_methods(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->isFinal()->willReturn(false);

        $this->validate($method)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }


    function it_is_fine_with_final_methods(Method $method)
    {
        $method->isAbstract()->willReturn(false);
        $method->isFinal()->willReturn(true);

        $this->validate($method)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_abstract_and_final_methods(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->isFinal()->willReturn(true);
        $method->getName()->willReturn('__construct');

        $this->validate($method)->shouldHaveType('Gnugat\Medio\Validator\Violation\SomeViolation');
    }
}

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

use Gnugat\Medio\Model\Object;
use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class ConcreteObjectMethodsCannotBeAbstractSpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\Constraint');
    }

    function it_is_fine_with_concrete_object_and_concrete_methods(Object $object, Method $method)
    {
        $object->getName()->willReturn('ConcreteClass');
        $object->isAbstract()->willReturn(false);
        $object->allMethods()->willReturn(array($method));
        $method->isAbstract()->willReturn(false);

        $this->validate($object)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_fine_with_abstract_objects(Object $object)
    {
        $object->isAbstract()->willReturn(true);

        $this->validate($object)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_concrete_object_and_abstract_methods(Object $object, Method $method)
    {
        $object->getName()->willReturn('ConcreteClass');
        $object->isAbstract()->willReturn(false);
        $object->allMethods()->willReturn(array($method));
        $method->isAbstract()->willReturn(true);
        $method->getName()->willReturn('abstractClass');

        $this->validate($object)->shouldHaveType('Gnugat\Medio\Validator\Violation\SomeViolation');
    }
}

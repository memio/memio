<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\Constant;
use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Object;
use Gnugat\Medio\Model\Property;
use PhpSpec\ObjectBehavior;

class ObjectSpec extends ObjectBehavior
{
    const FULLY_QUALIFIED_NAME = 'Gnugat\\Medio\\MyClass';
    const NAME = 'MyClass';
    const NAMESPACE_ = 'Gnugat\\Medio';

    function let()
    {
        $this->beConstructedWith(self::FULLY_QUALIFIED_NAME);
    }

    function it_is_a_structure()
    {
        $this->shouldImplement('Gnugat\Medio\Model\Structure');
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe(self::NAME);
    }

    function it_has_a_namespace()
    {
        $this->getNamespace()->shouldBe(self::NAMESPACE_);
    }

    function it_can_have_constants(Constant $constant)
    {
        $this->allConstants()->shouldBe(array());
        $this->addConstant($constant);
        $this->allConstants()->shouldBe(array($constant));
    }

    function it_can_have_properties(Property $property)
    {
        $this->allProperties()->shouldBe(array());
        $this->addProperty($property);
        $this->allProperties()->shouldBe(array($property));
    }

    function it_can_have_methods(Method $method)
    {
        $this->allMethods()->shouldBe(array());
        $this->addMethod($method);
        $this->allMethods()->shouldBe(array($method));
    }

    function it_can_have_a_parent(Object $parent)
    {
        $this->hasParent()->shouldBe(false);
        $this->getParent()->shouldBe(null);

        $this->extend($parent);
        $this->hasParent()->shouldBe(true);
        $this->getParent()->shouldBe($parent);

        $this->removeParent();
        $this->hasParent()->shouldBe(false);
        $this->getParent()->shouldBe(null);
    }

    function it_can_implement_contracts(Contract $contract)
    {
        $this->allContracts()->shouldBe(array());
        $this->implement($contract);
        $this->allContracts()->shouldBe(array($contract));
    }
}

<?php

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\Constant;
use PhpSpec\ObjectBehavior;

class ContractSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('MyInterface');
    }

    function it_is_a_structure()
    {
        $this->shouldImplement('Gnugat\Medio\Model\Structure');
    }

    function it_can_have_constants(Constant $constant)
    {
        $constants = $this->allConstants();

        $constants->all()->shouldBe(array());
        $this->addConstant($constant);
        $constants->all()->shouldBe(array($constant));
    }
}

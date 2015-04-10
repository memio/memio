<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\Validator\ModelValidator;

use Memio\Memio\Validator\ViolationCollection;
use Memio\Memio\Validator\ModelValidator\CollectionValidator;
use Memio\Memio\Validator\ModelValidator\MethodValidator;
use Memio\Model\Contract;
use Memio\Model\Method;
use PhpSpec\ObjectBehavior;

class ContractValidatorSpec extends ObjectBehavior
{
    function let(CollectionValidator $collectionValidator, MethodValidator $methodValidator)
    {
        $this->beConstructedWith($collectionValidator, $methodValidator);
    }

    function it_is_a_model_validator()
    {
        $this->shouldImplement('Memio\Memio\Validator\ModelValidator');
    }

    function it_supports_contracts(Contract $model)
    {
        $this->supports($model)->shouldBe(true);
    }

    function it_also_validates_methods(
        CollectionValidator $collectionValidator,
        MethodValidator $methodValidator,
        Contract $model,
        Method $method
    )
    {
        $constants = array();
        $contracts = array();
        $methods = array($method);
        $violationCollection1 = new ViolationCollection();
        $violationCollection2 = new ViolationCollection();
        $violationCollection3 = new ViolationCollection();
        $violationCollection4 = new ViolationCollection();

        $model->getName()->willReturn('Symfony\Component\HttpKernel\HttpKernelInterface');
        $model->allConstants()->willReturn($constants);
        $model->allContracts()->willReturn($contracts);
        $model->allMethods()->willReturn($methods);
        $collectionValidator->validate($constants)->willReturn($violationCollection1);
        $collectionValidator->validate($contracts)->willReturn($violationCollection2);
        $collectionValidator->validate($methods)->willReturn($violationCollection3);
        $methodValidator->validate($method)->willReturn($violationCollection4);

        $this->validate($model);
    }
}

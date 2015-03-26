<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Validator\ModelValidator;

use Gnugat\Medio\Validator\ViolationCollection;
use Gnugat\Medio\Validator\ModelValidator\CollectionValidator;
use Gnugat\Medio\Validator\ModelValidator\MethodValidator;
use Gnugat\Medio\Model\Object;
use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class ObjectValidatorSpec extends ObjectBehavior
{
    function let(CollectionValidator $collectionValidator, MethodValidator $methodValidator)
    {
        $this->beConstructedWith($collectionValidator, $methodValidator);
    }

    function it_is_a_model_validator()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\ModelValidator');
    }

    function it_supports_objects(Object $model)
    {
        $this->supports($model)->shouldBe(true);
    }

    function it_also_validates_methods(
        CollectionValidator $collectionValidator,
        MethodValidator $methodValidator,
        Object $model,
        Method $method
    )
    {
        $constants = array();
        $contracts = array();
        $methods = array($method);
        $properties = array();
        $violationCollection1 = new ViolationCollection();
        $violationCollection2 = new ViolationCollection();
        $violationCollection3 = new ViolationCollection();
        $violationCollection4 = new ViolationCollection();
        $violationCollection5 = new ViolationCollection();

        $model->getName()->willReturn('Symfony\Component\HttpKernel\HttpKernelInterface');
        $model->isAbstract()->willReturn(true);
        $model->allConstants()->willReturn($constants);
        $model->allContracts()->willReturn($contracts);
        $model->allMethods()->willReturn($methods);
        $model->allProperties()->willReturn($properties);
        $collectionValidator->validate($constants)->willReturn($violationCollection1);
        $collectionValidator->validate($contracts)->willReturn($violationCollection2);
        $collectionValidator->validate($properties)->willReturn($violationCollection3);
        $collectionValidator->validate($methods)->willReturn($violationCollection4);
        $methodValidator->validate($method)->willReturn($violationCollection5);

        $this->validate($model);
    }
}

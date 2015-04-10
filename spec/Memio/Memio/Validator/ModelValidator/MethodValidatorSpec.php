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
use Memio\Memio\Validator\ModelValidator\ArgumentValidator;
use Memio\Memio\Validator\ModelValidator\CollectionValidator;
use Memio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodValidatorSpec extends ObjectBehavior
{
    function let(ArgumentValidator $argumentValidator, CollectionValidator $collectionValidator)
    {
        $this->beConstructedWith($argumentValidator, $collectionValidator);
    }

    function it_is_a_model_validator()
    {
        $this->shouldImplement('Memio\Memio\Validator\ModelValidator');
    }

    function it_supports_methods(Method $model)
    {
        $this->supports($model)->shouldBe(true);
    }

    function it_also_validates_arguments(
        ArgumentValidator $argumentValidator,
        CollectionValidator $collectionValidator,
        Method $model
    )
    {
        $arguments = array();
        $violationCollection1 = new ViolationCollection();
        $violationCollection2 = new ViolationCollection();

        $model->isAbstract()->willReturn(false);
        $model->allArguments()->willReturn($arguments);
        $collectionValidator->validate($arguments)->willReturn($violationCollection1);
        $argumentValidator->validate($arguments)->willReturn($violationCollection2);

        $this->validate($model);
    }
}

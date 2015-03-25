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
use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodValidatorSpec extends ObjectBehavior
{
    function let(CollectionValidator $collectionValidator)
    {
        $this->beConstructedWith($collectionValidator);
    }

    function it_is_a_model_validator()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\ModelValidator');
    }

    function it_supports_methods(Method $model)
    {
        $this->supports($model)->shouldBe(true);
    }

    function it_also_validates_arguments(CollectionValidator $collectionValidator, Method $model)
    {
        $arguments = array();
        $violationCollection = new ViolationCollection();

        $model->isAbstract()->willReturn(false);
        $model->allArguments()->willReturn($arguments);
        $collectionValidator->validate($arguments)->willReturn($violationCollection);

        $this->validate($model);
    }
}

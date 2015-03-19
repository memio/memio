<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Validator\ModelValidator;
use PhpSpec\ObjectBehavior;

class ValidatorSpec extends ObjectBehavior
{
    function let(ModelValidator $modelValidator)
    {
        $this->add($modelValidator);
    }

    function it_is_silent_if_no_model_validator_supports_the_given_model(Argument $model, ModelValidator $modelValidator)
    {
        $modelValidator->supports($model)->willReturn(false);

        $this->validate($model);
    }

    function it_is_silent_with_valid_models(Argument $model, ModelValidator $modelValidator)
    {
        $modelValidator->supports($model)->willReturn(true);
        $modelValidator->validate($model)->shouldBeCalled();

        $this->validate($model);
    }

    function it_throws_an_exception_when_a_model_validator_fails(Argument $model, ModelValidator $modelValidator)
    {
        $invalidModelException = 'Gnugat\Medio\Exception\InvalidModelException';
        $modelValidator->supports($model)->willReturn(true);
        $modelValidator->validate($model)->willThrow($invalidModelException);

        $this->shouldThrow($invalidModelException)->duringValidate($model);
    }
}

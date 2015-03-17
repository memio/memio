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
use Gnugat\Medio\Validator\ValidatorStrategy;
use PhpSpec\ObjectBehavior;

class ValidatorSpec extends ObjectBehavior
{
    function let(ValidatorStrategy $validatorStrategy)
    {
        $this->add($validatorStrategy);
    }

    function it_is_silent_if_no_strategy_supports_the_given_model(Argument $model, ValidatorStrategy $validatorStrategy)
    {
        $validatorStrategy->supports($model)->willReturn(false);

        $this->validate($model);
    }

    function it_is_silent_with_valid_models(Argument $model, ValidatorStrategy $validatorStrategy)
    {
        $validatorStrategy->supports($model)->willReturn(true);
        $validatorStrategy->validate($model)->shouldBeCalled();

        $this->validate($model);
    }

    function it_throws_an_exception_when_a_validatorStrategy_fails(Argument $model, ValidatorStrategy $validatorStrategy)
    {
        $modelDomainException = 'Gnugat\Medio\Exception\DomainException';
        $validatorStrategy->supports($model)->willReturn(true);
        $validatorStrategy->validate($model)->willThrow($modelDomainException);

        $validatorDomainException = 'Gnugat\Medio\Exception\DomainException';
        $this->shouldThrow($validatorDomainException)->duringValidate($model);
    }
}

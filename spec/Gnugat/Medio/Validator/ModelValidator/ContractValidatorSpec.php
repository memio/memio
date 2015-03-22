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

use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Validator\ModelValidator\MethodValidator;
use Gnugat\Medio\Validator\ViolationCollection;
use PhpSpec\ObjectBehavior;

class ContractValidatorSpec extends ObjectBehavior
{
    function let(MethodValidator $methodValidator)
    {
        $this->beConstructedWith($methodValidator);
    }

    function it_is_a_model_validator()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\ModelValidator');
    }

    function it_supports_contracts(Contract $model)
    {
        $this->supports($model)->shouldBe(true);
    }

    function it_calls_method_validation_on_every_method(
        Contract $contract,
        Method $firstMethod,
        Method $secondMethod,
        MethodValidator $methodValidator,
        ViolationCollection $firstViolationCollection,
        ViolationCollection $secondViolationCollection
    )
    {
        $contract->allMethods()->willReturn(array($firstMethod, $secondMethod));

        $methodValidator->validate($firstMethod)->willReturn($firstViolationCollection);
        $methodValidator->validate($secondMethod)->willReturn($secondViolationCollection);

        $this->validate($contract);
    }
}

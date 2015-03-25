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
use Gnugat\Medio\Validator\ModelValidator\ContractValidator;
use Gnugat\Medio\Validator\ModelValidator\ObjectValidator;
use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Object;
use PhpSpec\ObjectBehavior;

class FileValidatorSpec extends ObjectBehavior
{
    function let(ContractValidator $contractValidator, ObjectValidator $objectValidator)
    {
        $this->beConstructedWith($contractValidator, $objectValidator);
    }

    function it_is_a_model_validator()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\ModelValidator');
    }

    function it_supports_contracts(File $model)
    {
        $this->supports($model)->shouldBe(true);
    }

    function it_also_validates_contract(
        Contract $contract,
        ContractValidator $contractValidator,
        File $model
    )
    {
        $violationCollection = new ViolationCollection();

        $model->getStructure()->willReturn($contract);
        $contractValidator->validate($contract)->willReturn($violationCollection);

        $this->validate($model);
    }

    function it_also_validates_object(
        Object $object,
        ObjectValidator $objectValidator,
        File $model
    )
    {
        $violationCollection = new ViolationCollection();

        $model->getStructure()->willReturn($object);
        $objectValidator->validate($object)->willReturn($violationCollection);

        $this->validate($model);
    }
}

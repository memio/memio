<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Validator;

use Gnugat\Medio\Validator\ViolationCollection;
use Gnugat\Medio\Validator\Violation\NoneViolation;
use Gnugat\Medio\Validator\Violation\SomeViolation;
use PhpSpec\ObjectBehavior;

class ViolationCollectionSpec extends ObjectBehavior
{
    const FIRST_MESSAGE = 'Model is invalid';
    const SECOND_MESSAGE = 'Model is wrong';

    function it_can_be_empty()
    {
        $this->all()->shouldBe(array());
    }

    function it_can_have_violations(SomeViolation $someViolation, SomeViolation $someOtherViolation)
    {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);
        $someOtherViolation->getMessage()->willReturn(self::SECOND_MESSAGE);

        $this->add($someViolation);
        $this->add($someOtherViolation);

        $this->all()->shouldBe(array(self::FIRST_MESSAGE, self::SECOND_MESSAGE));
    }

    function it_ignores_none_violations(NoneViolation $noneViolation)
    {
        $this->add($noneViolation);

        $this->all()->shouldBe(array());
    }

    function it_can_be_merged_with_other_collections(
        SomeViolation $someViolation,
        ViolationCollection $violationCollection
    )
    {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);
        $violationCollection->all()->willReturn(array(self::SECOND_MESSAGE));

        $this->add($someViolation);
        $this->merge($violationCollection);

        $this->all()->shouldBe(array(self::FIRST_MESSAGE, self::SECOND_MESSAGE));
    }
}

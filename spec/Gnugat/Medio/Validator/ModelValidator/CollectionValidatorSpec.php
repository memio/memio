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

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Constant;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Property;
use PhpSpec\ObjectBehavior;

class CollectionValidatorSpec extends ObjectBehavior
{
    function it_is_a_model_validator()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\ModelValidator');
    }

    function it_supports_argument_collections(Argument $model)
    {
        $this->supports(array($model))->shouldBe(true);
    }

    function it_supports_constant_collections(Constant $model)
    {
        $this->supports(array($model))->shouldBe(true);
    }

    function it_supports_method_collections(Method $model)
    {
        $this->supports(array($model))->shouldBe(true);
    }

    function it_supports_property_collections(Property $model)
    {
        $this->supports(array($model))->shouldBe(true);
    }

    function it_does_not_support_empty_collections()
    {
        $this->supports(array())->shouldBe(false);
    }
}

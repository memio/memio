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
use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;

class ArgumentValidatorSpec extends ObjectBehavior
{
    function it_is_a_model_validator()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\ModelValidator');
    }

    function it_supports_arguments(Argument $model)
    {
        $this->supports($model)->shouldBe(true);
    }
}

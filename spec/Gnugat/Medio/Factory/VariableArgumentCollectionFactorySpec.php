<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Factory;

use Gnugat\Medio\Factory\VariableArgumentFactory;
use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;

class VariableArgumentCollectionFactorySpec extends ObjectBehavior
{
    function let(VariableArgumentFactory $variableArgumentFactory)
    {
        $this->beConstructedWith($variableArgumentFactory);
    }

    function it_makes_a_collection_of_arguments_from_an_array_of_variables(
        Argument $argument,
        VariableArgumentFactory $variableArgumentFactory
    )
    {
        $callableVariable = function () {};
        $objectVariable = new \ArrayObject();
        $stringVariable = 'meh';

        $variableArgumentFactory->make($callableVariable)->willReturn($argument);
        $variableArgumentFactory->make($objectVariable)->willReturn($argument);
        $variableArgumentFactory->make($stringVariable)->willReturn($argument);

        $argumentCollection = $this->make(array($callableVariable, $objectVariable, $stringVariable));
        $argumentCollection->all()->shouldHaveCount(3);
    }
}

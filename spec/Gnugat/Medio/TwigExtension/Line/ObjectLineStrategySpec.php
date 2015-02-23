<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\TwigExtension\Line;

use Gnugat\Medio\Model\Object;
use PhpSpec\ObjectBehavior;

class ObjectLineStrategySpec extends ObjectBehavior
{
    const CONSTANT_BLOCK = 'constants';
    const PROPERTY_BLOCK = 'properties';

    function it_is_a_line_strategy()
    {
        $this->shouldImplement('Gnugat\Medio\TwigExtension\Line\LineStrategy');
    }

    function it_supports_objects(Object $object)
    {
        $this->supports($object)->shouldBe(true);
    }

    function it_needs_line_after_constants_if_object_has_both_constants_and_properties(Object $object)
    {
        $object->allConstants()->willReturn(array(1));
        $object->allProperties()->willReturn(array(2));
        $object->allMethods()->willReturn(array());

        $this->needsLineAfter($object, self::CONSTANT_BLOCK)->shouldBe(true);
    }

    function it_needs_line_after_constants_if_object_has_both_constants_and_methods(Object $object)
    {
        $object->allConstants()->willReturn(array(1));
        $object->allProperties()->willReturn(array());
        $object->allMethods()->willReturn(array(2));

        $this->needsLineAfter($object, self::CONSTANT_BLOCK)->shouldBe(true);
    }

    function it_needs_line_after_properties_if_object_has_both_properties_and_methods(Object $object)
    {
        $object->allConstants()->willReturn(array());
        $object->allProperties()->willReturn(array(1));
        $object->allMethods()->willReturn(array(2));

        $this->needsLineAfter($object, self::PROPERTY_BLOCK)->shouldBe(true);
    }
}

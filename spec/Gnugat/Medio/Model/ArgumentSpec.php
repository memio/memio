<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model;

use PhpSpec\ObjectBehavior;

class ArgumentSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('array', 'lines');
    }

    function it_has_a_type()
    {
        $this->getType()->shouldBe('array');
    }

    function it_can_have_a_type_hint()
    {
        $this->hasTypeHint()->shouldBe(true);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe('lines');
    }

    function it_can_be_renamed()
    {
        $this->rename('lineCollection');
        $this->getName()->shouldBe('lineCollection');
    }

    function it_can_be_an_object()
    {
        $this->beConstructedWith('DateTime', 'name');

        $this->isObject()->shouldBe(true);
    }

    function it_has_empty_default_value()
    {
        $this->beConstructedWith('DateTime', 'name');
        $this->getDefaultValue()->shouldBe(null);
    }
  
    function it_should_have_only_null_and_constant_default_value_for_objects()
    {
        $this->beConstructedWith('DateTime', 'name');
        $domainException = 'Gnugat\Medio\Exception\DomainException';
      
        $this->shouldThrow($domainException)->duringSetDefaultValue('"test"');
    }
  
    
    function it_can_be_null_default_value_for_object()
    {
        $this->beConstructedWith('DateTime', 'name');
        $this->setDefaultValue('null');
        $this->getDefaultValue()->shouldBe('null');
    }
  
    function it_can_be_self_constant_reference_default_value_for_object()
    {
        $this->beConstructedWith('DateTime', 'name');
        $this->setDefaultValue('self::DEFAULT_TIME');
        $this->getDefaultValue()->shouldBe('self::DEFAULT_TIME');
    }
  
    function it_can_be_constant_default_value_for_object()
    {
        $this->beConstructedWith('DateTime', 'name');
        $this->setDefaultValue('DEFAULT_TIME');
        $this->getDefaultValue()->shouldBe('DEFAULT_TIME');
    }
  
    function it_cant_be_constant_default_value_for_string_type()
    {
        $this->beConstructedWith('string', 'name');
        $this->setDefaultValue('DEFAULT_TIME');
        $this->getDefaultValue()->shouldBe('DEFAULT_TIME');
    }
  
    function it_can_be_removed_default_value()
    {
        $this->beConstructedWith('string', 'name');
        $this->setDefaultValue('DEFAULT_TIME');
        $this->getDefaultValue()->shouldBe('DEFAULT_TIME');
        $this->setDefaultValue(null);
        $this->getDefaultValue()->shouldBe(null);
    }
  
  
}

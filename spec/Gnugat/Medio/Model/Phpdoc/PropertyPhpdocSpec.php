<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model\Phpdoc;

use Gnugat\Medio\Model\Phpdoc\VariableTag;
use PhpSpec\ObjectBehavior;

class PropertyPhpdocSpec extends ObjectBehavior
{
    function it_can_be_empty()
    {
        $this->isEmpty()->shouldBe(true);
    }

    function it_can_have_a_property_tag(VariableTag $variableTag)
    {
        $this->setVariableTag($variableTag);
        $this->getVariableTag()->shouldBe($variableTag);
        $this->isEmpty(false);
    }
}

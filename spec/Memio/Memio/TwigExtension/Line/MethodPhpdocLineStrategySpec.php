<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\TwigExtension\Line;

use Memio\Model\Phpdoc\MethodPhpdoc;
use Memio\Model\Phpdoc\ApiTag;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\DeprecationTag;
use Memio\Model\Phpdoc\ParameterTag;
use PhpSpec\ObjectBehavior;

class MethodPhpdocLineStrategySpec extends ObjectBehavior
{
    function it_is_a_line_strategy()
    {
        $this->shouldImplement('Memio\Memio\TwigExtension\Line\LineStrategy');
    }

    function it_supports_method_phpdocs(MethodPhpdoc $methodPhpdoc)
    {
        $this->supports($methodPhpdoc)->shouldBe(true);
    }

    function it_needs_line_after_description_if_it_has_any_other_tag(
        Description $description,
        DeprecationTag $deprecationTag,
        MethodPhpdoc $methodPhpdoc
    )
    {
        $methodPhpdoc->getApiTag()->willReturn(null);
        $methodPhpdoc->getDescription()->willReturn($description);
        $methodPhpdoc->getDeprecationTag()->willReturn($deprecationTag);
        $methodPhpdoc->getParameterTags()->willReturn(null);

        $this->needsLineAfter($methodPhpdoc, 'description')->shouldBe(true);
    }

    function it_needs_line_after_parameter_tags_if_it_has_api_or_deprecation_tags(
        DeprecationTag $deprecationTag,
        MethodPhpdoc $methodPhpdoc,
        ParameterTag $parameterTag
    )
    {
        $methodPhpdoc->getApiTag()->willReturn(null);
        $methodPhpdoc->getDescription()->willReturn(null);
        $methodPhpdoc->getDeprecationTag()->willReturn($deprecationTag);
        $methodPhpdoc->getParameterTags()->willReturn(array($parameterTag));

        $this->needsLineAfter($methodPhpdoc, 'parameter_tags')->shouldBe(true);
    }

    function it_needs_line_after_deprecation_it_also_has_an_api_tag(
        ApiTag $apiTag,
        DeprecationTag $deprecationTag,
        MethodPhpdoc $methodPhpdoc
    )
    {
        $methodPhpdoc->getDeprecationTag()->willReturn($deprecationTag);
        $methodPhpdoc->getDescription()->willReturn(null);
        $methodPhpdoc->getApiTag()->willReturn($apiTag);
        $methodPhpdoc->getParameterTags()->willReturn(null);

        $this->needsLineAfter($methodPhpdoc, 'deprecation_tag')->shouldBe(true);
    }
}

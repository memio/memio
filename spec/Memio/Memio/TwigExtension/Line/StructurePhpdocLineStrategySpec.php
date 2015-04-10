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

use Memio\Model\Phpdoc\StructurePhpdoc;
use Memio\Model\Phpdoc\ApiTag;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\DeprecationTag;
use PhpSpec\ObjectBehavior;

class StructurePhpdocLineStrategySpec extends ObjectBehavior
{
    function it_is_a_line_strategy()
    {
        $this->shouldImplement('Memio\Memio\TwigExtension\Line\LineStrategy');
    }

    function it_supports_structure_phpdocs(StructurePhpdoc $structurePhpdoc)
    {
        $this->supports($structurePhpdoc)->shouldBe(true);
    }

    function it_needs_line_after_description_if_description_and_deprecation_or_api_are_defined(
        ApiTag $apiTag,
        Description $description,
        DeprecationTag $deprecationTag,
        StructurePhpdoc $structurePhpdoc
    )
    {
        $structurePhpdoc->getApiTag()->willReturn($apiTag);
        $structurePhpdoc->getDescription()->willReturn($description);
        $structurePhpdoc->getDeprecationTag()->willReturn($deprecationTag);

        $this->needsLineAfter($structurePhpdoc, 'description')->shouldBe(true);
    }

    function it_needs_line_after_deprecation_if_deprecation_and_api_are_defined(
        ApiTag $apiTag,
        Description $description,
        DeprecationTag $deprecationTag,
        StructurePhpdoc $structurePhpdoc
    )
    {
        $structurePhpdoc->getApiTag()->willReturn($apiTag);
        $structurePhpdoc->getDescription()->willReturn($description);
        $structurePhpdoc->getDeprecationTag()->willReturn($deprecationTag);

        $this->needsLineAfter($structurePhpdoc, 'deprecation_tag')->shouldBe(true);
    }
}

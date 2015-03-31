<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\Model\Phpdoc;

use Memio\Memio\Model\Phpdoc\ApiTag;
use Memio\Memio\Model\Phpdoc\Description;
use Memio\Memio\Model\Phpdoc\DeprecationTag;
use Memio\Memio\Model\Phpdoc\ParameterTag;
use PhpSpec\ObjectBehavior;

class MethodPhpdocSpec extends ObjectBehavior
{
    function it_can_be_empty()
    {
        $this->isEmpty()->shouldBe(true);
    }

    function it_can_have_description(Description $description)
    {
        $this->setDescription($description);
        $this->getDescription()->shouldBe($description);
        $this->isEmpty(false);
    }

    function it_can_have_parameters(ParameterTag $parameterTag)
    {
        $this->addParameterTag($parameterTag);
        $this->getParameterTags()->shouldBe(array($parameterTag));
        $this->isEmpty(false);
    }

    function it_can_be_tagged_as_api(ApiTag $apiTag)
    {
        $this->setApiTag($apiTag);
        $this->getApiTag()->shouldBe($apiTag);
        $this->isEmpty()->shouldBe(false);
    }

    function it_can_be_tagged_as_deprecated(DeprecationTag $deprecationTag)
    {
        $this->setDeprecationTag($deprecationTag);
        $this->getDeprecationTag()->shouldBe($deprecationTag);
        $this->isEmpty()->shouldBe(false);
    }
}

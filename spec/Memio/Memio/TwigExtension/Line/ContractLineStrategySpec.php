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

use Memio\Model\Contract;
use PhpSpec\ObjectBehavior;

class ContractLineStrategySpec extends ObjectBehavior
{
    const CONSTANT_BLOCK = 'constants';

    function it_is_a_line_strategy()
    {
        $this->shouldImplement('Memio\Memio\TwigExtension\Line\LineStrategy');
    }

    function it_supports_contracts(Contract $contract)
    {
        $this->supports($contract)->shouldBe(true);
    }

    function it_needs_line_after_constants_if_contract_has_both_constants_and_methods(Contract $contract)
    {
        $contract->allConstants()->willReturn(array(1));
        $contract->allMethods()->willReturn(array(2));

        $this->needsLineAfter($contract, self::CONSTANT_BLOCK)->shouldBe(true);
    }
}

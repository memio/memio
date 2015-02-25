<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Collection;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Contract;

class ContractCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroContracts()
    {
        $contracts = array();

        $generatedCode = $this->prettyPrinter->generateCode($contracts);

        $this->assertSame('', $generatedCode);
    }

    public function testOneContract()
    {
        $contracts = array(
            new Contract('Gnugat\\Medio\\MyContract'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($contracts);

        $this->assertSame("MyContract\n", $generatedCode);
    }

    public function testThreeContracts()
    {
        $contracts = array(
            new Contract('Gnugat\\Medio\\MyFirstContract'),
            new Contract('Gnugat\\Medio\\MySecondContract'),
            new Contract('Gnugat\\Medio\\MyThirdContract'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($contracts);

        $this->assertSame("MyFirstContract, MySecondContract, MyThirdContract\n", $generatedCode);
    }
}

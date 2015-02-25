<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Constant;
use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\Method;

class ContractTest extends PrettyPrinterTestCase
{
    const NAME = 'MyInterface';

    public function testEmpty()
    {
        $contract = new Contract(self::NAME);

        $generatedCode = $this->prettyPrinter->generateCode($contract);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $contract = Contract::make(self::NAME)
            ->addConstant(new Constant('FIRST_CONSTANT', '0'))
            ->addConstant(new Constant('SECOND_CONSTANT', "'meh'"))

            ->addMethod(Method::make('firstMethod')
                ->addArgument(new Argument('DateTime', 'firstArgument'))
                ->addArgument(new Argument('array', 'secondArgument'))
                ->addArgument(new Argument('string', 'thirdArgument'))
            )
            ->addMethod(new Method('secondMethod'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($contract);

        $this->assertExpectedCode($generatedCode);
    }
}

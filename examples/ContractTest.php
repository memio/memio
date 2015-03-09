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
use Gnugat\Medio\Model\Phpdoc\ApiTag;
use Gnugat\Medio\Model\Phpdoc\Description;
use Gnugat\Medio\Model\Phpdoc\DeprecationTag;
use Gnugat\Medio\Model\Phpdoc\StructurePhpdoc;

class ContractTest extends PrettyPrinterTestCase
{
    const NAME = 'MyInterface';

    public function testEmpty()
    {
        $contract = new Contract(self::NAME);

        $generatedCode = $this->prettyPrinter->generateCode($contract);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithPhpdoc()
    {
        $object = Contract::make(self::NAME)
            ->setPhpdoc(StructurePhpdoc::make()
                ->setDescription(Description::make('Short description')
                    ->addEmptyLine()
                    ->addLine('Longer description')
                )
                ->setDeprecationTag(new DeprecationTag('v2.1', 'Use Object instead'))
                ->setApiTag(new ApiTag('v2.0'))
            )
        ;

        $generatedCode = $this->prettyPrinter->generateCode($object);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $contract = Contract::make(self::NAME)
            ->extend(new Contract('FirstContract'))
            ->extend(new Contract('SecondContract'))

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

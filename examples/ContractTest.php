<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples;

use Memio\Model\Argument;
use Memio\Model\Constant;
use Memio\Model\Contract;
use Memio\Model\Method;
use Memio\Model\Phpdoc\ApiTag;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\DeprecationTag;
use Memio\Model\Phpdoc\StructurePhpdoc;

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
        $object = (new Contract(self::NAME))
            ->setPhpdoc((new StructurePhpdoc())
                ->setDescription((new Description('Short description'))
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
        $contract = (new Contract(self::NAME))
            ->extend(new Contract('FirstContract'))
            ->extend(new Contract('SecondContract'))

            ->addConstant(new Constant('FIRST_CONSTANT', '0'))
            ->addConstant(new Constant('SECOND_CONSTANT', "'meh'"))

            ->addMethod((new Method('firstMethod'))
                ->addArgument(new Argument('DateTime', 'firstArgument'))
                ->addArgument(new Argument('array', 'secondArgument'))
                ->addArgument(new Argument('mixed', 'thirdArgument'))
            )
            ->addMethod(new Method('secondMethod'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($contract);

        $this->assertExpectedCode($generatedCode);
    }
}

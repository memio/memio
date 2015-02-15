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
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Property;
use Gnugat\Medio\Model\Type;

class FileTest extends PrettyPrinterTestCase
{
    const FILENAME = '/tmp/medio/src/Gnugat/Medio/MyClass.php';

    public function testEmpty()
    {
        $file = new File(self::FILENAME);

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $file = File::make(self::FILENAME)
            ->addConstant(new Constant('FIRST_CONSTANT', '0'))
            ->addConstant(new Constant('SECOND_CONSTANT', "'meh'"))

            ->addProperty(new Property('firstProperty'))
            ->addProperty(new Property('secondProperty'))

            ->addMethod(Method::make('firstMethod')
                ->addArgument(new Argument(new Type('DateTime'), 'firstArgument'))
                ->addArgument(new Argument(new Type('array'), 'secondArgument'))
                ->addArgument(new Argument(new Type('string'), 'thirdArgument'))
            )
            ->addMethod(new Method('secondMethod'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }
}

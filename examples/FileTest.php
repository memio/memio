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
use Gnugat\Medio\Model\Import;
use Gnugat\Medio\Model\License;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Property;
use Gnugat\Medio\ValueObject\Type;

class FileTest extends PrettyPrinterTestCase
{
    const FILENAME = '/tmp/medio/src/Gnugat/Medio/MyClass.php';

    const PROJECT_NAME = 'gnugat/medio';
    const AUTHOR_NAME = 'Loïc Chardonnet';
    const AUTHOR_EMAIL = 'loic.chardonnet@gmail.com';

    public function testEmpty()
    {
        $file = new File(self::FILENAME);

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithLicense()
    {
        $file = new File(self::FILENAME);
        $license = new License(self::PROJECT_NAME, self::AUTHOR_NAME, self::AUTHOR_EMAIL);

        $generatedCode = $this->prettyPrinter->generateCode($file, array('license' => $license));

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $file = File::make(self::FILENAME)
            ->addImport(new Import('DateTime'))

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

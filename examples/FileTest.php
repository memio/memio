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
use Memio\Model\File;
use Memio\Model\FullyQualifiedName;
use Memio\Model\Method;
use Memio\Model\Object;
use Memio\Model\Phpdoc\LicensePhpdoc;
use Memio\Model\Property;

class FileTest extends PrettyPrinterTestCase
{
    const FILENAME = 'src/Vendor/Project/MyClass.php';
    const FULLY_QUALIFIED_NAME = 'Vendor\\Project\\MyClass';

    const PROJECT_NAME = 'vendor/project';
    const AUTHOR_NAME = 'Loïc Chardonnet';
    const AUTHOR_EMAIL = 'loic.chardonnet@gmail.com';

    public function testEmpty()
    {
        $file = File::make(self::FILENAME)
            ->setStructure(new Object(self::FULLY_QUALIFIED_NAME))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithLicense()
    {
        $file = File::make(self::FILENAME)
            ->setLicensePhpdoc(new LicensePhpdoc(self::PROJECT_NAME, self::AUTHOR_NAME, self::AUTHOR_EMAIL))

            ->setStructure(new Object(self::FULLY_QUALIFIED_NAME))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $file = File::make(self::FILENAME)
            ->addFullyQualifiedName(new FullyQualifiedName('DateTime'))

            ->setStructure(Object::make(self::FULLY_QUALIFIED_NAME)
                ->addConstant(new Constant('FIRST_CONSTANT', '0'))
                ->addConstant(new Constant('SECOND_CONSTANT', "'meh'"))

                ->addProperty(new Property('firstProperty'))
                ->addProperty(new Property('secondProperty'))

                ->addMethod(Method::make('firstMethod')
                    ->addArgument(new Argument('DateTime', 'firstArgument'))
                    ->addArgument(new Argument('array', 'secondArgument'))
                    ->addArgument(new Argument('string', 'thirdArgument'))
                )
                ->addMethod(new Method('secondMethod'))
        );

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }
}

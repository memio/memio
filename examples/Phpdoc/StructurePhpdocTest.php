<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Phpdoc;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Phpdoc\ApiTag;
use Gnugat\Medio\Model\Phpdoc\Description;
use Gnugat\Medio\Model\Phpdoc\DeprecationTag;
use Gnugat\Medio\Model\Phpdoc\StructurePhpdoc;

class StructurePhpdocTest extends PrettyPrinterTestCase
{
    public function testEmpty()
    {
        $structurePhpdoc = new StructurePhpdoc();

        $generatedCode = $this->prettyPrinter->generateCode($structurePhpdoc);

        $this->assertSame('', $generatedCode);
    }

    public function testOneTag()
    {
        $structurePhpdoc = StructurePhpdoc::make()
            ->setApiTag(new ApiTag())
        ;

        $generatedCode = $this->prettyPrinter->generateCode($structurePhpdoc);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $structurePhpdoc = StructurePhpdoc::make()
            ->setDescription(Description::make('Short description')
                ->addEmptyLine()
                ->addLine('Longer description')
            )
            ->setDeprecationTag(new DeprecationTag('v2.1', 'Use Object instead'))
            ->setApiTag(new ApiTag('v2.0'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($structurePhpdoc);

        $this->assertExpectedCode($generatedCode);
    }
}

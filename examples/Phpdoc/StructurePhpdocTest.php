<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Phpdoc;

use Memio\Memio\Examples\PrettyPrinterTestCase;
use Memio\Model\Phpdoc\ApiTag;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\DeprecationTag;
use Memio\Model\Phpdoc\StructurePhpdoc;

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
        $structurePhpdoc = (new StructurePhpdoc())
            ->setApiTag(new ApiTag())
        ;

        $generatedCode = $this->prettyPrinter->generateCode($structurePhpdoc);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $structurePhpdoc = (new StructurePhpdoc())
            ->setDescription((new Description('Short description'))
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

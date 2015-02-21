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
use Gnugat\Medio\Model\Import;
use Gnugat\Medio\ValueObject\Collection;

class ImportCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroImports()
    {
        $importCollection = new Collection('Gnugat\\Medio\\Model\\Import');

        $generatedCode = $this->prettyPrinter->generateCode($importCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneImport()
    {
        $importCollection = Collection::make('Gnugat\\Medio\\Model\\Import')
            ->add(new Import('DateTime'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($importCollection);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeImports()
    {
        $importCollection = Collection::make('Gnugat\\Medio\\Model\\Import')
            ->add(new Import('DateTime'))
            ->add(new Import('ArrayObject'))
            ->add(new Import('stdClass'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($importCollection);

        $this->assertExpectedCode($generatedCode);
    }
}

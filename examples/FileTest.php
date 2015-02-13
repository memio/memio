<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Method;

class FileTest extends PrettyPrinterTestCase
{
    const FILENAME = '/tmp/medio/src/Gnugat/Medio/MyClass.php';

    public function testEmpty()
    {
        $file = new File(self::FILENAME);

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithMethodOnly()
    {
        $file = File::make(self::FILENAME)
            ->addMethod(new Method('__construct'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }
}

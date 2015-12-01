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
use Memio\Model\Phpdoc\VariableTag;

class VariableTagTest extends PrettyPrinterTestCase
{
    public function testType()
    {
        $propertyTag = new VariableTag('string');

        $generatedCode = $this->prettyPrinter->generateCode($propertyTag);

        $this->assertSame('@var string', $generatedCode);
    }
}

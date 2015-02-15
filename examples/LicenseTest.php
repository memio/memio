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

use Gnugat\Medio\Model\MetaData\License;

class LicenseTest extends PrettyPrinterTestCase
{
    public function testSimpleOne()
    {
        $license = new License('gnugat/medio', 'Loïc Chardonnet', 'loic.chardonnet@gmail.com');

        $generatedCode = $this->prettyPrinter->generateCode($license);

        $this->assertExpectedCode($generatedCode);
    }
}

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

use Gnugat\Medio\Model\License;

class LicenseTest extends PrettyPrinterTestCase
{
    const PROJECT_NAME = 'gnugat/medio';
    const AUTHOR_NAME = 'Loïc Chardonnet';
    const AUTHOR_EMAIL = 'loic.chardonnet@gmail.com';

    public function testSimpleOne()
    {
        $license = new License(self::PROJECT_NAME, self::AUTHOR_NAME, self::AUTHOR_EMAIL);

        $generatedCode = $this->prettyPrinter->generateCode($license);

        $this->assertExpectedCode($generatedCode);
    }
}

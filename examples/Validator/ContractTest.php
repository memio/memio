<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Validator;

use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Validator;
use PHPUnit_Framework_TestCase;

class ContractTest extends PHPUnit_Framework_TestCase
{
    private $validator;

    protected function setUp()
    {
        $this->validator = new Validator();
    }

    /**
     * @expectedException \Gnugat\Medio\Exception\InvalidModelException
     * @expectedExceptionMessage Contract "HttpKernelInterface" Method "handle" cannot be static
     */
    public function testMethodsCannotBeStatic()
    {
        $contract = Contract::make('HttpKernelInterface')
            ->addMethod(Method::make('handle')
                ->makeStatic()
            )
        ;

        $this->validator->validate($contract);
    }
}

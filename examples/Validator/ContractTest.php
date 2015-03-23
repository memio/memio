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
     * @expectedExceptionMessage Contract "HttpKernelInterface" Method "handle" can only be public
     */
    public function testMethodsCanOnlyBePublic()
    {
        $contract = Contract::make('HttpKernelInterface')
            ->addMethod(Method::make('handle')
                ->makeProtected()
            )
        ;

        $this->validator->validate($contract);
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

    /**
     * @expectedException \Gnugat\Medio\Exception\InvalidModelException
     * @expectedExceptionMessage Contract "HttpKernelInterface" Method "handle" cannot have a body
     */
    public function testMethodsCannotHaveBody()
    {
        $contract = Contract::make('HttpKernelInterface')
            ->addMethod(Method::make('handle')
                ->setBody('echo "nobody expects the spanish inquisition";')
            )
        ;

        $this->validator->validate($contract);
    }
}

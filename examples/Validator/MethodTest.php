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

use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Validator;
use PHPUnit_Framework_TestCase;

class MethodTest extends PHPUnit_Framework_TestCase
{
    private $validator;

    protected function setUp()
    {
        $this->validator = new Validator();
    }

    /**
     * @expectedException \Gnugat\Medio\Exception\InvalidModelException
     * @expectedExceptionMessage Method "__construct" cannot be abstract and have a body
     */
    public function testCannotBeAbstractAndHaveBody()
    {
        $method = Method::make('__construct')
            ->makeAbstract()
            ->setBody('echo "Nobody expects the spanish inquisition";')
        ;

        $this->validator->validate($method);
    }

    /**
     * @expectedException \Gnugat\Medio\Exception\InvalidModelException
     * @expectedExceptionMessage Method "__construct" cannot be both abstract and final
     */
    public function testCannotBeBothAbstractAndFinal()
    {
        $method = Method::make('__construct')
            ->makeAbstract()
            ->makeFinal()
        ;

        $this->validator->validate($method);
    }

    /**
     * @expectedException \Gnugat\Medio\Exception\InvalidModelException
     * @expectedExceptionMessage Method "__construct" cannot be both abstract and private
     */
    public function testCannotBeBothAbstractAndPrivate()
    {
        $method = Method::make('__construct')
            ->makeAbstract()
            ->makePrivate()
        ;

        $this->validator->validate($method);
    }
}

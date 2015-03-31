<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Validator;

use Memio\Memio\Exception\InvalidModelException;
use Memio\Memio\Model\Argument;
use Memio\Memio\Model\Contract;
use Memio\Memio\Model\Constant;
use Memio\Memio\Model\File;
use Memio\Memio\Model\Method;
use Memio\Memio\Validator;
use PHPUnit_Framework_TestCase;

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    private $validator;

    protected function setUp()
    {
        $this->validator = new Validator();
    }

    public function testUnsupported()
    {
        $collection = array('filename', 'filename');

        $this->validator->validate($collection);
    }

    public function testNoViolations()
    {
        $arguments = array(
            new Argument('string', 'filename'),
            new Argument('array', 'parameters'),
        );

        $this->validator->validate($arguments);
    }

    /**
     * @expectedException \Memio\Memio\Exception\InvalidModelException
     * @expectedExceptionMessage Collection "Argument" cannot have name "filename" duplicates (2 occurences)
     */
    public function testOneViolation()
    {
        $arguments = array(
            new Argument('string', 'filename'),
            new Argument('string', 'filename'),
        );

        $this->validator->validate($arguments);
    }

    public function testThreeViolations()
    {
        $file = File::make('src/Symfony/Component/HttpKernel/HttpKernelInterface.php')
            ->setStructure(Contract::make('Symfony\Component\HttpKernel\HttpKernelInterface')
                ->addMethod(Method::make('handle')
                    ->addArgument(new Argument('Symfony\Component\HttpFoundation\Request', 'request'))
                    ->addArgument(new Argument('Symfony\Component\HttpFoundation\Request', 'request'))
                    ->addArgument(new Argument('Symfony\Component\HttpFoundation\Request', 'request'))

                    ->makePrivate()
                    ->setBody('echo "nobody expects the spanish inquisition";')
                )
            )
        ;

        try {
            $this->validator->validate($file);
        } catch (InvalidModelException $e) {
            $messages = explode("\n", $e->getMessage());
            $this->assertSame(array(
                'Contract "HttpKernelInterface" Method "handle" can only be public',
                'Contract "HttpKernelInterface" Method "handle" cannot have a body',
                'Collection "Argument" cannot have name "request" duplicates (3 occurences)',
            ), $messages);
        }
    }

    public function testManyViolations()
    {
        $file = File::make('src/Symfony/Component/HttpKernel/HttpKernelInterface.php')
            ->setStructure(Contract::make('Symfony\Component\HttpKernel\HttpKernelInterface')
                ->addConstant(new Constant('MY_CONSTANT', '23'))
                ->addConstant(new Constant('MY_CONSTANT', '42'))

                ->addMethod(Method::make('handle')
                    ->addArgument(Argument::make('Symfony\Component\HttpFoundation\Request', 'request')
                        ->setDefaultValue('42')
                    )
                    ->addArgument(new Argument('Symfony\Component\HttpFoundation\Request', 'request'))
                    ->addArgument(new Argument('Symfony\Component\HttpFoundation\Request', 'request'))

                    ->makeAbstract()
                    ->makeFinal()
                    ->makePrivate()
                    ->setBody('echo "nobody expects the spanish inquisition";')
                )
            )
        ;

        try {
            $this->validator->validate($file);
        } catch (InvalidModelException $e) {
            $messages = explode("\n", $e->getMessage());
            $this->assertSame(array(
                'Contract "HttpKernelInterface" Method "handle" can only be public',
                'Contract "HttpKernelInterface" Method "handle" cannot be final',
                'Contract "HttpKernelInterface" Method "handle" cannot have a body',
                'Collection "Constant" cannot have name "MY_CONSTANT" duplicates (2 occurences)',
                'Method "handle" cannot be abstract and have a body',
                'Method "handle" cannot be both abstract and final',
                'Method "handle" cannot be both abstract and private',
                'Collection "Argument" cannot have name "request" duplicates (3 occurences)',
                'Object Argument "request" can only default to null',
            ), $messages);
        }
    }
}

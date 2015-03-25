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

use Gnugat\Medio\Exception\InvalidModelException;
use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Validator;
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
     * @expectedException \Gnugat\Medio\Exception\InvalidModelException
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
}

<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples;

use Memio\Model\Argument;
use Memio\Model\Method;
use Memio\Model\Phpdoc\MethodPhpdoc;
use Memio\Model\Phpdoc\ParameterTag;

class MethodTest extends PrettyPrinterTestCase
{
    public function testWithReturnType()
    {
        $body = <<<'EOT'
        return [];
EOT;
        $method = (new Method('returnsSomething'))
            ->setReturnType('array')
            ->setBody($body)
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithoutArguments()
    {
        $method = new Method('isEnabled');

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithInlineArguments()
    {
        $method = new Method('it_has_too_many_argument_yes');
        $method->addArgument(new Argument('int', 'argument1'));
        $method->addArgument(new Argument('int', 'argument2'));

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithMultilineArguments()
    {
        $method = new Method('it_has_too_many_argument_yeah');
        $method->addArgument(new Argument('int', 'argument1'));
        $method->addArgument(new Argument('int', 'argument2'));

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithMultilineArgumentsAndReturnType()
    {
        $body = <<<'EOT'
        return [];
EOT;
        $method = (new Method('it_has_too_many_argument_yeah_yeah'))
            ->addArgument(new Argument('int', 'argument1'))
            ->addArgument(new Argument('int', 'argument2'))
            ->setReturnType('array')
            ->setBody($body)
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithPhpdoc()
    {
        $arguments = array(
            'Symfony\Component\HttpFoundation\Request' => 'request',
            'int' => 'type',
            'bool' => 'catch',
        );
        $phpdoc = new MethodPhpdoc();
        $method = (new Method('handle'))
            ->setPhpdoc($phpdoc)
        ;
        foreach ($arguments as $type => $name) {
            $method->addArgument(new Argument($type, $name));
            $phpdoc->addParameterTag(new ParameterTag($type, $name));
        }

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testNoVisibility()
    {
        $method = Method::make('it_has_phpspec_style')
            ->removeVisibility()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testPrivateVisibility()
    {
        $method = Method::make('extractMe')
            ->makePrivate()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testProtectedVisibility()
    {
        $method = Method::make('inheritanceIsBad')
            ->makeProtected()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testStatic()
    {
        $method = Method::make('method')
            ->makeStatic()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithBody()
    {
        $body = <<<'EOT'
        $length = strlen('Nobody expects the spanish inquisition');
EOT;

        $method = Method::make('method')
            ->setBody($body)
        ;

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testAbstract()
    {
        $method = Method::make('method')->makeAbstract();

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertSame('    public abstract function method();', $generatedCode);
    }
}

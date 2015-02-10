<?php

namespace Gnugat\Medio\Examples;

use DI\ContainerBuilder;
use PHPUnit_Framework_TestCase;

class PrettyPrinterTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Gnugat\Medio\PrettyPrinter
     * @Inject
     */
    protected $prettyPrinter;

    protected function setUp()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(__DIR__.'/../config/phpdi.php');
        $container = $containerBuilder->build();
        $container->injectOn($this);
    }
}

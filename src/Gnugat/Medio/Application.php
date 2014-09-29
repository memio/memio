<?php

namespace Gnugat\Medio;

use Gnugat\Medio\Convertor;
use Gnugat\Medio\PhpEditor;
use Gnugat\Medio\Command\Command;
use Gnugat\Medio\Command\InjectDependencyCommand;
use Gnugat\Medio\Command\SpecDependencyCommand;
use Gnugat\Redaktilo\EditorFactory;

class Application
{
    /**
     * @var array of Command
     */
    private $commands = array();

    public function __construct()
    {
        $convertor = new Convertor();
        $editor = EditorFactory::createEditor();
        $phpEditor = new PhpEditor($editor);
        $injectDependencyCommand = new InjectDependencyCommand($convertor, $phpEditor);
        $specDependencyCommand = new SpecDependencyCommand($convertor, $phpEditor);

        $this->commands['d:i'] = $injectDependencyCommand;
        $this->commands['d:s'] = $specDependencyCommand;
    }

    /**
     * @param int    $argc
     * @param string $argv
     *
     * @return int
     */
    public function run($argc, $argv)
    {
        $command = $this->commands[$argv[1]];

        return $command->run($argv[2], $argv[3]);
    }
}

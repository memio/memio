<?php

namespace Gnugat\Medio;

use Gnugat\Medio\Convertor;
use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeEditor;
use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Medio\Service\MultilineEditor;
use Gnugat\Medio\Command\InjectDependencyCommand;
use Gnugat\Redaktilo\EditorFactory;

class Application
{
    /**
     * @var array of Gnugat\Medio\Command\Command;
     */
    private $commands = array();

    public function __construct()
    {
        $convertor = new Convertor();
        $editor = EditorFactory::createEditor();
        $codeNavigator = new CodeNavigator($editor);
        $codeDetector = new CodeDetector($codeNavigator, $editor);
        $multilineEditor = new MultilineEditor($codeDetector, $codeNavigator, $editor);
        $codeEditor = new CodeEditor($codeDetector, $codeNavigator, $editor, $multilineEditor);
        $injectDependencyCommand = new InjectDependencyCommand($codeDetector, $codeEditor, $convertor, $editor);

        $this->commands['d:i'] = $injectDependencyCommand;
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

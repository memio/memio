<?php

namespace Gnugat\Medio\Command;

use Gnugat\Medio\Convertor;
use Gnugat\Medio\Editor;

class SpecDependencyCommand implements Command
{
    /**
     * @var Convertor
     */
    private $convertor;

    /**
     * @var Editor
     */
    private $editor;

    /**
     * @param Convertor $convertor
     * @param Editor    $editor
     */
    public function __construct(Convertor $convertor, Editor $editor)
    {
        $this->convertor = $convertor;
        $this->editor = $editor;
    }

    /**
     * @param string $fullyQualifiedlassname
     * @param string $filename
     *
     * @return int
     */
    public function run($fullyQualifiedlassname, $filename)
    {
        $className = $this->convertor->toClassName($fullyQualifiedlassname);
        $variableName = $this->convertor->toVariableName($className);

        $file = $this->editor->open($filename);

        $this->editor->addUse($file, $fullyQualifiedlassname);
        $this->editor->addDependencyMock($file, $className, $variableName);

        $this->editor->save($file);

        return Command::EXIT_SUCCESS;
    }
}

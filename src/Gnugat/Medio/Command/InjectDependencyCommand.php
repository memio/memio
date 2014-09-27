<?php

namespace Gnugat\Medio\Command;

use Gnugat\Medio\Convertor;
use Gnugat\Medio\Editor;

class InjectDependencyCommand implements Command
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
     * @param string $fullyQualifiedClassname
     * @param string $filename
     *
     * @return int
     */
    public function run($fullyQualifiedClassname, $filename)
    {
        $className = $this->convertor->toClassName($fullyQualifiedClassname);
        $variableName = $this->convertor->toVariableName($className);

        $file = $this->editor->open($filename);
        $this->editor->addUse($file, $fullyQualifiedClassname);
        $this->editor->addProperty($file, $className, $variableName);
        $this->editor->addDependency($file, $className, $variableName);

        return Command::EXIT_SUCCESS;
    }
}

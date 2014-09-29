<?php

namespace Gnugat\Medio\Command;

use Gnugat\Medio\Convertor;
use Gnugat\Medio\PhpEditor;

class InjectDependencyCommand implements Command
{
    /**
     * @var Convertor
     */
    private $convertor;

    /**
     * @var PhpEditor
     */
    private $phpEditor;

    /**
     * @param Convertor $convertor
     * @param PhpEditor $phpEditor
     */
    public function __construct(Convertor $convertor, PhpEditor $phpEditor)
    {
        $this->convertor = $convertor;
        $this->phpEditor = $phpEditor;
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

        $file = $this->phpEditor->open($filename);
        $this->phpEditor->addUse($file, $fullyQualifiedClassname);
        $this->phpEditor->addProperty($file, $className, $variableName);
        $this->phpEditor->addDependency($file, $className, $variableName);
        $this->phpEditor->save($file);

        return Command::EXIT_SUCCESS;
    }
}

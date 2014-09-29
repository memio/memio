<?php

namespace Gnugat\Medio\Command;

use Gnugat\Medio\Convertor;
use Gnugat\Medio\PhpEditor;

class SpecDependencyCommand implements Command
{
    /**
     * @var Convertor
     */
    private $convertor;

    /**
     * @var PhpEditor
     */
    private $phpPhpEditor;

    /**
     * @param Convertor $convertor
     * @param PhpEditor $phpPhpEditor
     */
    public function __construct(Convertor $convertor, PhpEditor $phpPhpEditor)
    {
        $this->convertor = $convertor;
        $this->phpPhpEditor = $phpPhpEditor;
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

        $file = $this->phpPhpEditor->open($filename);

        $this->phpPhpEditor->addUse($file, $fullyQualifiedlassname);
        $this->phpPhpEditor->addDependencyMock($file, $className, $variableName);

        $this->phpPhpEditor->save($file);

        return Command::EXIT_SUCCESS;
    }
}

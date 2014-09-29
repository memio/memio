<?php

namespace Gnugat\Medio;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\File;
use Gnugat\Redaktilo\Text;

class PhpEditor
{
    /**
     * @var Editor
     */
    private $editor;

    public function __construct(Editor $editor)
    {
        $this->editor = $editor;
    }

    /**
     * @param string $filename
     *
     * @return File
     */
    public function open($filename)
    {
        return $this->editor->open($filename);
    }

    /**
     * @param File $file
     */
    public function save(File $file)
    {
        return $this->editor->save($file);
    }

    /**
     * @param Text   $text
     * @param string $fullyQualifiedClassname
     */
    public function addUse(Text $text, $fullyQualifiedClassname)
    {
        $useStatement = sprintf('use %s;', $fullyQualifiedClassname);
        $emptyLine = '';

        $text->setCurrentLineNumber(0);
        $this->editor->jumpBelow($text, '/^namespace /');
        $lineNumber = $text->getCurrentLineNumber();
        $text->setCurrentLineNumber($lineNumber + 1);
        $this->editor->insertBelow($text, $useStatement);
        $this->editor->insertBelow($text, $emptyLine);
    }

    /**
     * @param Text   $text
     * @param string $className
     * @param string $variableName
     */
    public function addProperty(Text $text, $className, $variableName)
    {
        $property = sprintf('    private $%s;', $variableName);
        $emptyLine = '';

        $text->setCurrentLineNumber(0);
        $this->editor->jumpBelow($text, '/^{$/');
        $this->editor->insertBelow($text, $property);
        $this->editor->insertBelow($text, $emptyLine);
    }

    /**
     * @param Text   $text
     * @param string $className
     * @param string $variableName
     */
    public function addDependency(Text $text, $className, $variableName)
    {
        $constructorArgument = sprintf('        %s $%s', $className, $variableName);
        $dependency = sprintf('        $this->%s = $%s;', $variableName, $variableName);

        $text->setCurrentLineNumber(0);
        $this->editor->jumpBelow($text, '/^    public function __construct\(/');
        $this->editor->insertBelow($text, $constructorArgument);
        $this->editor->jumpBelow($text, '/^    {/');
        $this->editor->insertBelow($text, $dependency);
    }

    /**
     * @param Text   $text
     * @param string $className
     * @param string $variableName
     */
    public function addDependencyMock(Text $text, $className, $variableName)
    {
        $constructorArgument = sprintf('        %s $%s', $className, $variableName);
        $dependency = sprintf('            $%s', $variableName);

        $text->setCurrentLineNumber(0);
        $this->editor->jumpBelow($text, '/^    function let\(/');
        $this->editor->insertBelow($text, $constructorArgument);
        $this->editor->jumpBelow($text, '/^        \$this->beConstructedWith\(/');
        $this->editor->insertBelow($text, $dependency);
    }
}

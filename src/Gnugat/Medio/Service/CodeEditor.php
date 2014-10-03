<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\File;
use Gnugat\Redaktilo\Text;
use Gnugat\Redaktilo\Search\PatternNotFoundException;

class CodeEditor
{
    const EMPTY_LINE = '';

    /**
     * @var CodeDetector
     */
    private $codeDetector;

    /**
     * @var CodeNavigator
     */
    private $codeNavigator;

    /**
     * @var Editor
     */
    private $editor;

    public function __construct(CodeDetector $codeDetector, CodeNavigator $codeNavigator, Editor $editor)
    {
        $this->codeDetector = $codeDetector;
        $this->codeNavigator = $codeNavigator;
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

        $this->codeNavigator->goToNamespace($text);
        $this->codeNavigator->goOneLineBelow($text);
        $this->editor->insertBelow($text, $useStatement);
        if (!$this->codeDetector->hasOneUseBelow($text)) {
            $this->editor->insertBelow($text, self::EMPTY_LINE);
        }
    }

    /**
     * @param Text   $text
     * @param string $variableName
     */
    public function addProperty(Text $text, $variableName)
    {
        $property = sprintf('    private $%s;', $variableName);
        $emptyLine = '';

        $this->codeNavigator->goToClassOpening($text);
        while ($this->codeDetector->hasOneUseBelow($text)) {
            $this->codeNavigator->goOneUseBelow($text);
        }
        $this->editor->insertBelow($text, $property);
        $this->editor->insertBelow($text, self::EMPTY_LINE);
    }
}

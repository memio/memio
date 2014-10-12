<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio;

use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeEditor;
use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Medio\Service\MultilineEditor;
use Gnugat\Medio\Command\InjectDependencyCommand;
use Gnugat\Redaktilo\EditorFactory;

class Container
{
    /**
     * @var \Gnugat\Redaktilo\Editor
     */
    private static $editor;

    /**
     * @var CodeNavigator
     */
    private static $codeNavigator;

    /**
     * @var CodeDetector
     */
    private static $codeDetector;

    /**
     * @var MultilineEditor
     */
    private static $multilineEditor;

    /**
     * @var CodeEditor
     */
    private static $codeEditor;

    /**
     * @var Convertor
     */
    private static $convertor;

    /**
     * @var InjectDependencyCommand
     */
    private static $injectDependencyCommand;

    /**
     * @var Application
     */
    private static $application;

    /**
     * @return \Gnugat\Redaktilo\Editor
     */
    public static function getEditor()
    {
        if (!self::$editor) {
            self::$editor = EditorFactory::createEditor();
        }

        return self::$editor;
    }

    /**
     * @return CodeNavigator
     */
    public static function getCodeNavigator()
    {
        if (!self::$codeNavigator) {
            $editor = self::getEditor();

            self::$codeNavigator = new CodeNavigator($editor);
        }

        return self::$codeNavigator;
    }

    /**
     * @return CodeDetetor
     */
    public static function getCodeDetector()
    {
        if (!self::$codeDetector) {
            $codeNavigator = self::getCodeNavigator();
            $editor = self::getEditor();

            self::$codeDetector = new CodeDetector($codeNavigator, $editor);
        }

        return self::$codeDetector;
    }

    /**
     * @return MultilineEditor
     */
    public static function getMultilineEditor()
    {
        if (!self::$multilineEditor) {
            $codeDetector = self::getCodeDetector();
            $codeNavigator = self::getCodeNavigator();
            $editor = self::getEditor();

            self::$multilineEditor = new MultilineEditor($codeDetector, $codeNavigator, $editor);
        }

        return self::$multilineEditor;
    }

    /**
     * @return CodeEditor
     */
    public static function getCodeEditor()
    {
        if (!self::$codeEditor) {
            $codeDetector = self::getCodeDetector();
            $codeNavigator = self::getCodeNavigator();
            $multilineEditor = self::getMultilineEditor();
            $editor = self::getEditor();

            Self::$codeEditor = new CodeEditor($codeDetector, $codeNavigator, $editor, $multilineEditor);
        }

        return self::$codeEditor;
    }

    /**
     * @return Convertor
     */
    public static function getConvertor()
    {
        if (!self::$convertor) {
            self::$convertor = new Convertor();
        }

        return self::$convertor;
    }

    /**
     * @return InjectDependencyCommand
     */
    public static function getInjectDependencyCommand()
    {
        if (!self::$injectDependencyCommand) {
            $codeDetector = self::getCodeDetector();
            $codeEditor = self::getCodeEditor();
            $convertor = self::getConvertor();
            $editor = self::getEditor();

            self::$injectDependencyCommand = new InjectDependencyCommand(
                $codeDetector,
                $codeEditor,
                $convertor,
                $editor
            );
        }

        return self::$injectDependencyCommand;
    }

    /**
     * @return Application
     */
    public static function getApplication()
    {
        if (!self::$application) {
            $injectDependencyCommand = self::getInjectDependencyCommand();

            self::$application = new Application();
            self::$application->addCommand('d:i', $injectDependencyCommand);
        }

        return self::$application;
    }
}

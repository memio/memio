<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class CodeDetectorSpec extends ObjectBehavior
{
    const NAMESPACE_STATEMENT = 'namespace fixture\Gnugat\Medio\Dependency;';
    const NAME_SPACE = 'fixture\Gnugat\Medio\Dependency';

    function let(Editor $editor)
    {
        $this->beConstructedWith($editor);
    }

    function it_detects_if_use_statement_is_needed(Editor $editor, Text $text)
    {
        $editor->has($text, self::NAMESPACE_STATEMENT)->willReturn(true);

        $this->isUseNeeded($text, self::NAME_SPACE)->shouldBe(false);
    }

    function it_detects_if_use_statement_is_not_needed(Editor $editor, Text $text)
    {
        $editor->has($text, self::NAMESPACE_STATEMENT)->willReturn(false);

        $this->isUseNeeded($text, self::NAME_SPACE)->shouldBe(true);
    }
}

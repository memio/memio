<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model\MetaData;

use PhpSpec\ObjectBehavior;

class LicenseSpec extends ObjectBehavior
{
    const PROJECT_NAME = 'gnugat/medio';
    const AUTHOR_NAME = 'Loïc Chardonnet';
    const AUTHOR_EMAIL = 'loic.chardonnet@gmail.com';

    function let()
    {
        $this->beConstructedWith(self::PROJECT_NAME, self::AUTHOR_NAME, self::AUTHOR_EMAIL);
    }

    function it_has_project_name()
    {
        $this->getProjectName()->shouldBe(self::PROJECT_NAME);
    }

    function it_has_author_name()
    {
        $this->getAuthorName()->shouldBe(self::AUTHOR_NAME);
    }

    function it_has_author_email()
    {
        $this->getAuthorEmail()->shouldBe(self::AUTHOR_EMAIL);
    }
}

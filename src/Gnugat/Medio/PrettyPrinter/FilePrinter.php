<?php

namespace Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\File;
use Twig_Environment;

class FilePrinter
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param File $file
     *
     * @return string
     */
    public function dump(File $file)
    {
        return $this->twig->render('class.txt.twig', array('file' => $file));
    }
}

<?php

use DI\Container;
use Gnugat\Medio\TwigExtension\Line\Line;

return array(
    'Gnugat\\Medio\\TwigExtension\\Line\\Line' => DI\factory(function (Container $c) {
        $line = new Line();
        $line->add($c->get('Gnugat\\Medio\\TwigExtension\\Line\\ContractLineStrategy'));
        $line->add($c->get('Gnugat\\Medio\\TwigExtension\\Line\\FileLineStrategy'));
        $line->add($c->get('Gnugat\\Medio\\TwigExtension\\Line\\ObjectLineStrategy'));

        return $line;
    }),

    'medio.templates' => __DIR__.'/../templates',

    'Twig_Loader_Filesystem' => DI\object()
        ->constructor(DI\link('medio.templates')),

    'Twig_Environment' => DI\factory(function (Container $c) {
        $twig = new Twig_Environment($c->get('Twig_Loader_Filesystem'));
        $twig->addExtension($c->get('Gnugat\\Medio\\TwigExtension\\Phpdoc'));
        $twig->addExtension($c->get('Gnugat\\Medio\\TwigExtension\\Type'));
        $twig->addExtension($c->get('Gnugat\\Medio\\TwigExtension\\Whitespace'));

        return $twig;
    }),
);

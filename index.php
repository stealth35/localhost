<?php
require_once __DIR__.'/vendor/autoload.php'; 

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__,
));

$app->get('/', function() use($app) {
    $finder = new Symfony\Component\Finder\Finder();
    $finder->directories()->in(__DIR__)->exclude('vendor')->depth('== 0');

    $infos = array(PHP_VERSION, PHP_SAPI, PHP_OS);
    $extensions = get_loaded_extensions();
    natcasesort($extensions);

    return $app['twig']->render('index.html.twig', array(
        'directories' => $finder,
        'infos'       => $infos,
        'extensions'  => $extensions
    ));
});

$app->run(); 
<?php

require_once __DIR__.'/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__);
$twig = new Twig_Environment($loader);

$finder = new Symfony\Component\Finder\Finder();
$finder->directories()->in(__DIR__)->exclude('vendor')->depth('== 0');

$extensions = get_loaded_extensions();
natcasesort($extensions);

echo $twig->render('index.html.twig',array (
    'host'        => $_SERVER['SERVER_NAME'],
    'directories' => $finder,
    'infos'       => array(PHP_VERSION, PHP_SAPI, PHP_OS),
    'extensions'  => $extensions
));
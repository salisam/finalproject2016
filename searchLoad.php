<?php
/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/22/16
 * Time: 2:08 PM
 */


require_once 'Twig/Autoloader.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('searchpage.html.twig');
$params =array(
    'aName' => 'Sam'
);

$template->display($params);
<?php

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);

//adasdsa
//$template = $twig->loadTemplate('basicView.html.twig');

//$params =array(
//	'aName' => 'Sam'
//	);

//$template->display($params);

echo $twig->render('basicView.html.twig',[

]);
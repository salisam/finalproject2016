<?php
/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/30/16
 * Time: 7:14 PM
 */

session_start();

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

include_once 'Sneaker.php';

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);

echo $twig->render('checkout', [
//    'data' => $data,
//    'total'=>$total
]);
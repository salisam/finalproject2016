<?php
/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/21/16
 * Time: 12:14 PM
 */

require_once 'Twig/Autoloader.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);
$obj= new Sneaker();
$x=$obj->displaySneakers();
$f=$x->fetch_all(MYSQLI_ASSOC);

$data['products']=$f;
echo $twig->render('product_view.html.twig',[
        'products'=>$f
    ]
    );
//$params =array(
//    'aName' => 'Sam'
//);

//$template->display($params);
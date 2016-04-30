<?php
/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/30/16
 * Time: 3:44 PM
 */

session_start();

$total=0;

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

include_once 'Sneaker.php';

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);

$s = new Sneaker();

if(isset($_REQUEST['search'])) {

    $search = $_REQUEST['search'];

    $data = $s->search($search);

    array("data"=>$data);

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $id => $sneaker_details) {
            $count++;
            $total += $_SESSION['cart'][$id]['total'];
        }
    }

    echo $twig->render('search', [
        'data' => $data,
        'total'=>$total
    ]);

}
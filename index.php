<?php

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

include_once 'Sneaker.php';

session_start();

$count = 0;
$total = 0;

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);

$s = new Sneaker();

$data = $s->allSneaker();

$row = $data->fetch_all(MYSQLI_ASSOC);

$all['data'] = $row;

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $id => $sneaker_details) {
        $count++;
        $total += $_SESSION['cart'][$id]['total'];
    }
}


echo $twig->render('index.twig',[
'data'=>$row,
    'total'=>$total,
    'count'=>$count
]);
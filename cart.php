<?php
/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/30/16
 * Time: 5:40 PM
 */

session_start();

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

include_once 'Sneaker.php';

$total=0;

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);

$s = new Sneaker();

if(isset($_GET['id']) && isset($_GET['c'])){

    $c = $_GET['c'];
    $id = $_GET['id'];

    switch($c){
        case 'add':
            $_SESSION['cart'][$id]['quantity']++;
            $data = $s->selectSneaker($id);
            $addItem = $data->fetch_array(MYSQLI_ASSOC);

            $_SESSION['cart'][$id] = [
                'id' => $addItem['id'],
                'brand_name' => $addItem['brand_name'],
                'size' => $addItem['size'],
                'quantity' => $_SESSION['cart'][$id]['quantity'],
                'price' => $addItem['price'],
                'color'=>$addItem['color'],
                'image'=>$addItem['image'],
                'total' => $addItem['price'] * $_SESSION['cart'][$id]['quantity']
            ];
            break;

        case 'minus':
            $_SESSION['cart'][$id]['quantity']--;
            $ss = $s->selectSneaker($id);
            $addItem = $ss->fetch_array(MYSQLI_ASSOC);

            $_SESSION['cart'][$id] = [
                'id' => $addItem['id'],
                'brand_name' => $addItem['brand_name'],
                'size' => $addItem['size'],
                'quantity' => $_SESSION['cart'][$id]['quantity'],
                'price' => $addItem['price'],
                'color'=>$addItem['color'],
                'image'=>$addItem['image'],
                'total' => $addItem['price'] * $_SESSION['cart'][$id]['quantity']
            ];

            if($_SESSION['cart'][$id]['quantity']<= 0){
                unset($_SESSION['cart'][$id]);
            }
            break;

    }
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $id => $sneaker_details) {
        $total += $_SESSION['cart'][$id]['total'];
    }
}

    echo $twig->render('cart', [
        'cart' => isset($_SESSION['cart']) ? $_SESSION['cart'] : '',
        'total'=> $total
    ]);

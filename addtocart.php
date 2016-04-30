<?php
/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/30/16
 * Time: 4:20 PM
 */

session_start();

include_once 'Sneaker.php';

$sneaker = new Sneaker();

if (isset($_GET['id'])) {

    $sid = $_GET['id'];

    if (!isset($_SESSION['cart'][$sid])) {

        $cc = $sneaker->selectSneaker($sid);

        $addItem = $cc->fetch_array(MYSQLI_ASSOC);
        $_SESSION['cart'][$sid] = [
            'id' => $addItem['id'],
            'brand_name' => $addItem['brand_name'],
            'size' => $addItem['size'],
            'quantity' => 1,
            'price' => $addItem['price'],
            'color'=>$addItem['color'],
            'image'=>$addItem['image'],
            'total' => $addItem['price']
        ];
    }
    else{
        header('Location: index.php');
    }

header('Location: index.php');
    print_r($_SESSION['cart']);
//    unset($_SESSION['cart']);
}



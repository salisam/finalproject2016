<?php
/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/30/16
 * Time: 7:35 PM
 */

include_once 'Mail.php';
include_once 'Encrypt.php';
include_once 'Sneaker.php';

$m = new Mail();
$e = new Encryption();
$s = new Sneaker();

if(isset($_POST['firstname'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $tf = stripcslashes($firstname);
    $tl = stripcslashes($lastname);
    $te = stripcslashes($email);
    $ta = stripcslashes($address);

    $sf = strip_tags($tf);
    $sl = strip_tags($tl);
    $se = strip_tags($te);
    $sa = strip_tags($ta);
//
    if(strlen($sf) == 0 || strlen($sl) == 0 || strlen($se) == 0 || strlen($sa) == 0){
        header('Location: checkout.php');
    }
    else{
//
        $ef = $e->encrypt($sf);
        $el = $e->encrypt($sl);
        $ee = $e->encrypt($se);
        $ea = $e->encrypt($sa);

        $s->insert($ef,$el,$ee,$ea);
//
        $m->alert($sf,$sl,$se);

        header('Location: done.html');
    }

}
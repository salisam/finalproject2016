<?php

/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/30/16
 * Time: 9:05 PM
 */
class Encryption
{
    public function encrypt($data)
    {
        $pass = 'dz!123$%UUKL';
        $method = 'aes128';
        $options = 0;
        $iv = "urbangear9010890";
        $encrypted = openssl_encrypt($data, $method, $pass, $options, $iv);
        return $encrypted;
    }

    public function decrypt($data)
    {
        $pass = 'dz!123$%UUKL';
        $method = 'aes128';
        $options = 0;
        $iv = "urbangear9010890";
        $decrypted = openssl_decrypt($data, $method, $pass, $options, $iv);
        return $decrypted;
    }


}
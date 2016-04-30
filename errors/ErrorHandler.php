<?php
/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 26/02/2016
 * Time: 14:37
 */
//ini_set('error_reporting', E_NOTICE);
//ini_set('error_reporting', E_WARNING);
//ini_set('error_reporting', E_WARNING|E_NOTICE);
//ini_set('error_reporting', E_ERROR);
//error_reporting(0);

//echo "Demonstrating warning and fatal errors";
//
//$ans = $_GET['val1'] + $var2;
//
//echo "</br>The product is " . $ans;
//
//echo "This line creates a warning</br>";
//
//mysql_connect("localhost", "root", "root");
//
//echo "Another warning</br>";
//
//$x = 1 / $var2;
//
//echo "This line will result in fatal error</br>";
//
//echo "call to undefined fuctnion" . str(1 / $var2);
//
//echo " This line will not print because of earlier error";

error_reporting(E_ALL);
//ini_set("display_errors", "off");
//define('ERROR_LOG_FILE', getcwd() . '/error_log2.txt');
date_default_timezone_set('UTC');

set_error_handler(function ($errno, $errstr, $file, $line, $context) {
    if (error_reporting() === 0) {
        return false;
    }
    switch ($errno) {

        case E_WARNING:
        case E_USER_WARNING:
        case E_COMPILE_WARNING:
        case E_RECOVERABLE_ERROR:

            break;

        case E_NOTICE:
        case E_USER_NOTICE:
            echo "<b>Error:</b> [$errno] $errstr";
//            print_r($context);
            error_log("\n[" . date('l jS F Y h:i:s A') . "]\n{$errstr}\nError occurred in " . $file . "\nON LINE " . $line . "\n", 3,
                getcwd() . "/error_log.txt");
            break;

        case E_PARSE:
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
            throw new ErrorException ();
            break;

        default:
            break;
    }
});


//set_error_handler("customError");


echo "$rofe";

echo $_GET[“undefined”];


//error handler function
//function customError($errno, $errstr) {
//    echo "<b>Error:</b> [$errno] $errstr";
//}
//
////set error handler
//set_error_handler("customError");
//
////trigger error
//echo($test);


//function customHandler($number, $string, $file, $line, $context)
//{
//    switch ($number) {
//        case E_WARNING:
//        case E_NOTICE:
////print "<h1>Sorry, an error has occured</h1>";
////exit;
//            print "<hr><font color=\"red\">\n";
//            print "<b>Custom Error Handler -- Warning/Notice<b>\n";
//            print "<br>An error has occurred on {$line} line in the {$file}
//file.\n";
//            print "<br>The error is a \"{$string}\" (error #{$number}).\n ";
//            print "<br>Context info:<br>\n<pre>\n";
//            print_r($context);
//            print "\n</pre></font>\n<hr>\n";
////error logging: Folder shd be writeable
//            error_log("Just to let you know we loggd it\n", 3,
//                getcwd() . "/mylog.txt");
//            break;
//        default:
//// Do nothing
//            print "<h1>A bad error occurred! {$string}</h1>";
//    }
//}
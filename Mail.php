<?php

/**
 * Created by PhpStorm.
 * User: sooryen_macbook001
 * Date: 4/30/16
 * Time: 7:36 PM
 */

require_once './PHPMailer-master/PHPMailerAutoload.php';

class Mail

{
    public function confirmation($firstname, $lastname, $email)
    {
        $cust = $firstname . ' ' . $lastname;
        $mail = new PHPMailer;
//        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sam.sali@ashesi.edu.gh';
        $mail->Password = 'sweetpapaya';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('sam.sali@ashesi.edu.gh', 'Urban Gear');
        $mail->addAddress($email, $cust);
        $mail->isHTML(true);
        $mail->Subject = 'Your Order is Being Processed';
        $mail->Body = '<p>Hi ' . $cust . '</p> <p>Your order is being processed. We will get back to you within the next 24hrs.</p>
        <p>Thank you for shopping with Urban Gear.</p><br> <p style="text-align: left">The Urban Gear Team</p>';
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        if (!$mail->send()) {
            return false;
            trigger_error("Error sending mail.");
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return true;
            echo 'Message has been sent';
        }
    }

    public function alert($firstname, $lastname, $email)
    {
        $cust = $firstname . ' ' . $lastname;
        $mail = new PHPMailer;
//        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sam.sali@ashesi.edu.gh';
        $mail->Password = 'sweetpapaya';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('sam.sali@ashesi.edu.gh', 'Urban Gear');
        $mail->addAddress($email, $cust);
        $mail->isHTML(true);
        $mail->Subject = 'Your Order is Being Processed';
        $mail->Body = '<p>Hi ' . $cust . '</p> <p>Your order has been processed. Your delivery will get to you in the next 24hrs.</p>
        <p>Thank you for shopping with Urban Gear.</p><br> <p style="text-align: left">The Urban Gear Team</p>';
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        if (!$mail->send()) {
            return false;
            trigger_error("Error sending mail.");
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return true;
            echo 'Message has been sent';
        }
    }
}
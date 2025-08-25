<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function send_mail($sent_to_email, $sent_to_fullname, $subject, $content, $option = array()) {
    global $config;
    $config_email = $config['email'];
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;  // nếu để là 0 sẽ không có thông báo debug SMTP::DEBUG_SERVER                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'ngoainguhoc24@gmail.com';                     //SMTP username
        $mail->Password = 'xhns zqos mzqy oqmz';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465; // ssl còn 587 là tls
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';

        //Recipients
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
        $mail->addAddress($sent_to_email, $sent_to_fullname);     //Add a recipient
//    $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');
        //Attachments
//        $mail->addAttachment('congchua.jpg');         //Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name // tên thay thế
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $content;
//        $mail->Subject = '[PHP MASTER] Gửi mail từ Unitop';
//        $mail->Body = 'Thông tin được gửi từ chương trình <b>PHP Master</b>';
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
//        return true;
//        echo 'Đã gửi thành công';
    } catch (Exception $e) {
        echo "Email không được gửi:Chi tiết lỗi: {$mail->ErrorInfo}";
    }
}

<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';


class Msg{

    public function envia($email, $assunto, $texto, $nome){
        try {
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

            //Server settings
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mx1.hostinger.co.uk';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'contact@2x-shopping.com';                 // SMTP username
            $mail->Password = 'Io7zuxgjVK8W';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('contact@2x-shopping.com', 'Malanza - 2X-Shopping');
            $mail->addAddress($email, $nome);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('contact@2x-shopping.com', 'Malanza - 2X-Shopping');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //pode por pdf

            //Content

            $body = $texto;
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $assunto;
            $mail->Body    = utf8_encode($body);
            $mail->AltBody = strip_tags($body);

            $mail->send();
           return true;
        } catch (Exception $e) {

        }
        return false;
    }
}



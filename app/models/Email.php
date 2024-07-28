<?php
// email.php

namespace Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

/**
 * users model
 */

class Email extends Model {
    private $from ;
    private $to;
    private $password;
    private $subject;
    private $message;
    private $headers;
    private $otp;

    public function __construct($to, $otp, $subject, $message) {
        $this->from = SENDER_EMAIL;
        $this->password = EMAIL_PASSWORD;
        $this->to = $to;
        $this->otp = $otp;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = "From:  $this->from \r\n";
        $this->headers .= "Reply-To: $to\r\n";
        $this->headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
    }

     // Method to send email
     public function send() {
        // return mail($this->to, $this->subject, $this->message, $this->headers);

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        $res = false;
        try {
            // SMTP configuration (example for Gmail)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $this->from; // Your Gmail address
            $mail->Password = $this->password ; // Your Gmail password or app password if 2FA enabled
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient details
            $mail->setFrom($this->from, APP_NAME);
            $mail->addAddress($this->to, '');

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body = $this->message;

            // Send email
            if ($mail->send()) {
                // Store OTP and its expiration time (e.g., 5 minutes from now) in session
                $res =  true;
                $_SESSION['email']['otp'] = $this->otp;
                $_SESSION['email']['otp_expires'] = time() + (5 * 60); // Expiration time: 5 minutes
            } else {
                $res =  false;
            }
            
        } catch (Exception $e) {
             $res =  false;
            // $res =  "Otp could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return $res;
    }

     // Method to generate OTP
     public static function generateOTP($length = 6) {
        return rand(pow(10, $length-1), pow(10, $length)-1);
    }


}
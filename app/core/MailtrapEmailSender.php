<?php

require 'vendor/autoload.php'; 
// Require the Composer autoloader

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class MailtrapEmailSender {
    private $smtpServer;
    private $smtpPort;
    private $smtpUsername;
    private $smtpPassword;
    private $mailer;

    public function __construct($smtpServer, $smtpPort, $smtpUsername, $smtpPassword) {
        $this->smtpServer = $smtpServer;
        $this->smtpPort = $smtpPort;
        $this->smtpUsername = $smtpUsername;
        $this->smtpPassword = $smtpPassword;

        // Set up Swift Mailer with Mailtrap SMTP configuration
        $transport = (new Swift_SmtpTransport($this->smtpServer, $this->smtpPort))
            ->setUsername($this->smtpUsername)
            ->setPassword($this->smtpPassword);

        $this->mailer = new Swift_Mailer($transport);
    }

    public function sendEmail($to, $subject, $body) {
        // Create a message
        $message = (new Swift_Message($subject))
            ->setFrom([$this->smtpUsername => 'Your Name'])
            ->setTo($to)
            ->setBody($body);

        // Send the message
        return $this->mailer->send($message);
    }
}

// Usage
$smtpServer = 'smtp.mailtrap.io';
$smtpPort = 2525;
$smtpUsername = 'your_mailtrap_username';
$smtpPassword = 'your_mailtrap_password';

$mailer = new MailtrapEmailSender($smtpServer, $smtpPort, $smtpUsername, $smtpPassword);

$to = 'recipient@example.com';
$subject = 'Test Email';
$body = 'This is a test email sent through Mailtrap using OOP approach.';

if ($mailer->sendEmail($to, $subject, $body)) {
    echo 'Email sent successfully.';
} else {
    echo 'Failed to send email.';
}
?>

<?php
// email.php

class Email {
    private $to;
    private $subject;
    private $message;
    private $headers;

    public function __construct($to, $subject, $message) {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = "From: your_email@example.com\r\n";
        $this->headers .= "Reply-To: your_email@example.com\r\n";
        $this->headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    }

    public function send() {
        return mail($this->to, $this->subject, $this->message, $this->headers);
    }
}

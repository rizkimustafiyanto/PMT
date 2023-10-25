<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once APPPATH . 'third_party/PHPMailer/src/Exception.php';
require_once APPPATH . 'third_party/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'third_party/PHPMailer/src/SMTP.php';

class Email
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
    }

    public function sendEmail($to, $subject, $message)
    {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->Port = '465';
            $this->mailer->SMTPAuth = true;
            $this->mailer->SMTPSecure = 'ssl';
            $this->mailer->Username = 'it.psdjkt@gmail.com';
            $this->mailer->Password = 'jvjeiuwnmjjernzx';
            $this->mailer->setFrom('it.psdjkt@gmail.com', 'Persada PMT');
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->isHTML(true);
            $this->mailer->Body = $message;

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            echo 'Gagal mengirim email. Error: ' . $this->mailer->ErrorInfo;
            return false;
        }
    }
}

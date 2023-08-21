<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once APPPATH . 'third_party/PHPMailer/src/Exception.php';
require_once APPPATH . 'third_party/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'third_party/PHPMailer/src/SMTP.php';

class Email
{

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
    }

    public function sendEmail($to, $subject, $message)
    {
        try {
            // smtp.office365.com
            $this->mailer->isSMTP();
            // $this->mailer->Host = 'smtp.office365.com';
            $this->mailer->Host = 'smtp.gmail.com';
            // $this->mailer->Port = '587';
            $this->mailer->Port = '465';
            $this->mailer->SMTPAuth = true;
            // $this->mailer->SMTPSecure = 'tls';
            $this->mailer->SMTPSecure = 'ssl';
            $this->mailer->Username = 'it.psdjkt@gmail.com';
            $this->mailer->Password = 'jvjeiuwnmjjernzx';
            $this->mailer->setFrom('it.psdjkt@gmail.com', 'ITPSD'); //harus sama dengan nama emailnya
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $message;

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            echo $this->mailer->ErrorInfo;
            return false;
            // echo 'Gagal mengirim email. Error: ' . $e->getMessage();
        }
    }
}

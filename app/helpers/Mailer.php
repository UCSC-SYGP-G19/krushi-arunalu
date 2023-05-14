<?php

/**
 * @file
 * Provides a mailer class to handle emails using phpmailer
 */

namespace app\helpers;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    private static PHPMailer $mail;

    public static function init(): void
    {
        self::$mail = new PHPMailer(true);
        self::$mail->isSMTP();
        self::$mail->Host = 'smtp.gmail.com';
        self::$mail->SMTPAuth = true;
        self::$mail->Username = EMAIL_FROM;
        self::$mail->Password = EMAIL_APP_PASSWORD;
        self::$mail->SMTPSecure = "tls";
        self::$mail->Port = 587;
    }

    public static function send($to, $subject, $body): bool
    {
        try {
            self::$mail->setFrom(EMAIL_FROM, EMAIL_NAME);
            self::$mail->addAddress($to);
            self::$mail->isHTML(true);
            self::$mail->Subject = $subject;
            self::$mail->Body = $body;

            if (self::$mail->send()) {
                self::$mail->smtpClose();
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
        self::$mail->smtpClose();
        return false;
    }
}

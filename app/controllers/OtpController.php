<?php

/**
 * @file
 * Controller for handling email and phone OTPs
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Mailer;
use app\helpers\Util;

class OtpController extends Controller
{
    public string $base = URL_ROOT . "/otp";

    public function index(): void
    {

        Util::redirect("/not-found");
    }

    public function sendOtpToEmail(): bool
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim(implode(", ", $_POST));

            if ($email == null || $email == "") {
                http_response_code(400);
                return false;
            }

            $otp = Util::generateOtp();

            $subject = "OTP for email verification | Krushi Arunalu";
            $message = "Your OTP for email verification is: $otp";
            $message .= "\n\nThis OTP will only be valid for 1 hour.";
            $headers = "From: krushi.arunalu" . EMAIL_FROM . "\r";
            Mailer::init();
            if (!Mailer::send($email, $subject, $message)) {
                Logger::log("INFO", "OTP sending failed to email: " . $email);
                http_response_code(500);
                return false;
            };

            Logger::log("INFO", "OTP sent to email: " . $email);

            $this->loadModel('OtpEntry');
            $this->model->fillData([
                "timestamp" => date("Y-m-d H:i:s"),
                "type" => "email",
                "otp" => $otp,
            ]);

//            if ($this->sendOtpToEmail($otp, Session::getSession()->email)) {
//                Logger::log("INFO", "OTP sent to email: " . Session::getSession()->email);
//                $this->loadModel("OtpEntry");
//                $this->model->fillData([
//                    'userId' => Session::getSession()->id,
//                    'otp' => $otp,
//                ]);
//                $this->model->addToDB();
//            } else {
//                Logger::log("INFO", "OTP sending failed to email: " . Session::getSession()->email);
//            }

            if ($this->model->addToDb()) {
                $id = $this->model->getLastInsertedId();
                http_response_code(200);
                Logger::log("INFO", "OTP saved to DB");
                $this->sendArrayAsJson(["Message" => "OTP sent to email address", "id" => $id]);
                return true;
            } else {
                http_response_code(500);
            }
        } else {
            http_response_code(405);
        }
        return false;
    }
}

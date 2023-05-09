<?php

/**
 * @file
 * Register controller with register functionality
 * Currently supports only Producers and Manufacturer roles
 */

namespace app\controllers;

use app\core\Controller;
use app\core\Model;
use app\helpers\Flash;
use app\helpers\Logger;
use app\helpers\Util;
use app\models\District;

class RegisterController extends Controller
{
    public function index()
    {
        $this->loadView('Common/RegisterPage', 'Register');
        $this->view->fieldOptions["p_district"] = District::getNamesFromDB();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->register();
        }

        $this->view->render();
    }

    private function register(): void
    {
        // If email_otp is entered, check it
        $email_otp = $_POST['email_otp'] ?? null;
        $email_otp_id = $_POST['email_otp_id'] ?? null;
        if (!empty($email_otp) && !empty($email_otp_id)) {
            if (!$this->validateEmailOtp($email_otp, $email_otp_id)) {
                $this->view->fieldErrors['email_otp'] = "Invalid email verification code, please try again";
                $this->refillValuesAndShowError();
                Flash::setMessage(
                    Flash::ERROR,
                    "Registration failed",
                    "Invalid email verification code, please try again"
                );
                return;
            }
        }


        // Apply custom validations for special fields common to both roles
        if (!isset($_POST['role'])) {
            $this->view->fieldErrors['role'] = "Please select a user role";
        }

        if (!isset($_POST['t&c'])) {
            $this->view->fieldErrors['t&c'] = "Please accept the Terms & Conditions";
        }

        if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $this->view->fieldErrors['confirm_password'] = "Passwords do not match";
            }
        }

        if ($_POST['role'] === 'Producer') {
            $this->view->fieldValues['role'] = $_POST['role'];
            // Validate fields specific to Producer role
            $required_fields = ['p_name', 'p_nic', 'p_address', 'p_district', 'p_contact_no', 'p_email_address'];

            $this->validateFields($required_fields);

            $_POST['p_email_address'] = filter_var($_POST['p_email_address'], FILTER_VALIDATE_EMAIL);
            if (!$_POST['p_email_address']) {
                $this->view->fieldErrors['p_email_address'] = "Invalid email address";
            }

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                return;
            }

            $this->registerAsProducer();
        } elseif ($_POST['role'] === 'Manufacturer') {
            $this->view->fieldValues['role'] = 'Manufacturer';
            // Validate fields specific to Manufacturer role
            $this->registerAsManufacturer();
        } else {
            $this->view->fields = $_POST;
            $this->view->error = "Invalid user role";
        }
    }

    private function validateEmailOtp($email_otp, $email_otp_id): bool
    {
        $stmt = Model::select(
            table: "generated_otp",
            columns: ['otp', 'timestamp'],
            where: ['id' => $email_otp_id]
        );
        if ($stmt) {
            $res = $stmt->fetch();
            if (is_object($res)) {
                $otp = $res->otp;
                $timestamp = $res->timestamp;
                if ($otp === $email_otp) {
                    if (time() - strtotime($timestamp) < 60 * 60) {
                        // OTP is valid
                        return true;
                    } else {
                        $this->view->fieldErrors['email_otp'] = "OTP has expired";
                    }
                } else {
                    $this->view->fieldErrors['email_otp'] = "Invalid OTP";
                }
            } else {
                $this->view->fieldErrors['email_otp'] = "Invalid OTP";
            }
        }
        return false;
    }

    private function registerAsProducer()
    {
        $this->loadModel('Producer');
        $this->model->fillData([
            'role' => $_POST['role'],
            'name' => $_POST['p_name'],
            'address' => $_POST['p_address'],
            'lastLogin' => null,
            'imageUrl' => $_POST['avatar_url'],
            'email' => $_POST['p_email_address'],
            'contactNo' => $_POST['p_contact_no'],
            'password' => $_POST['password'],
            'nicNumber' => $_POST['p_nic'],
            'district' => $_POST['p_district']
        ]);
        if ($this->model->register()) {
            $this->view->fields = [];
            Logger::log("SUCCESS", "Producer registered with email " . $_POST['email']);
            Flash::setToastMessage(
                Flash::SUCCESS,
                "Registration successful",
                "Please login using either your email or phone number"
            );
            Util::redirect('login');
            exit();
        } else {
            http_response_code(500);
            $this->view->fields = $_POST;
            Flash::setMessage(
                Flash::ERROR,
                "Registration failed",
                "Registration failed, please try again"
            );
            $this->view->error = "Registration failed, please try again";
        }
    }

    private function registerAsManufacturer()
    {
        $this->loadModel('Manufacturer');
        $this->model->fillData([
            'role' => $_POST['role'],
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'lastLogin' => null,
            'imageUrl' => null,
            'email' => $_POST['email'],
            'contactNo' => $_POST['contact_no'],
            'password' => $_POST['password'],
            'brNumber' => $_POST['nic/br'],
            'coverImageUrl' => null,
            'description' => null,
        ]);
        if ($this->model->register()) {
            $this->view->fields = [];
            Logger::log("SUCCESS", "Manufacturer registered with email " . $_POST['email']);
            Util::redirect('login');
        } else {
            $this->view->fields = $_POST;
            $this->view->error = "Registration failed, please try again";
        }
    }

    public function uploadAvatar(): void
    {
        $uploaded_file_name = null;
        $uploaded_file_path = null;

        if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
            $avatar = $_FILES["avatar"];
            $file_name = $avatar["name"];
            $file_size = $avatar["size"];
            $file_tmp = $avatar["tmp_name"];
            $file_type = $avatar["type"];

            $array = explode('.', $avatar["name"]);
            $file_ext = strtolower(end($array));

            $extensions = array("jpeg", "jpg", "png");

            // Check if file is a valid image
            if (in_array($file_ext, $extensions) && getimagesize($file_tmp)) {
                $uploaded_file_name = md5(microtime()) . '.' . $file_ext;
                $uploaded_file_path = UPLOADS_ROOT . '/user-avatars/' . $uploaded_file_name;
                move_uploaded_file($file_tmp, $uploaded_file_path);
            } else {
                // Display error message
                Logger::log("ERROR", "Invalid image file uploaded: $file_name");
                http_response_code(400);
                $this->sendArrayAsJson(['result' => 'error', 'error' => 'Invalid image file']);
                return;
            }
        }

        Logger::log("INFO", "Uploaded avatar: $uploaded_file_path");
        http_response_code(201);
        $this->sendArrayAsJson(['result' => 'success', 'file_name' => $uploaded_file_name, 'file_path' => $uploaded_file_path]);
    }

    public function registerCustomer()
    {
        $this->loadView('Customer/RegisterPage', 'Register Customer');
        if (isset($_POST['registerCustomer'])) {
            $this->registerAsCustomer();
        }
        $this->view->render();
    }

    private function registerAsCustomer()
    {
        $required_fields = ['name', 'contact_no', 'email', 'password', 'confirm_password', 't&c'];

        $this->validateFields($required_fields);

        // Apply custom validations for special fields
        if (!isset($_POST['t&c'])) {
            $this->view->fieldErrors['t&c'] = "Please accept the Terms & Conditions";
        }

        $_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$_POST['email']) {
            $this->view->fieldErrors['email'] = "Invalid email address";
        }

        if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $this->view->fieldErrors['confirm_password'] = "Passwords do not match";
            }
        }

        if (!empty($this->view->fieldErrors)) {
            $this->refillValuesAndShowError();
            return;
        }
        $this->view->fields = $_POST;
//        $this->view->error = "Invalid user role";

        //fill data to Customer
        $this->loadModel('Customer');
        $this->model->fillData([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'contactNo' => $_POST['contact_no'],
            'address' => '',
            'password' => $_POST['password'],
        ]);
        if ($this->model->register()) {
            $this->view->fields = [];
            Logger::log("SUCCESS", "Customer registered with email " . $_POST['email']);
            Util::redirect('./');
        } else {
            $this->view->fields = $_POST;
            $this->view->error = "Registration failed, please try again";
        }
    }
}

<?php

use app\views\inc\components\InputField;
use app\views\inc\components\SelectField;

include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto">
<?php
include APP_ROOT . "/views/inc/components/LoggedInNavbarWithoutSidebar.php"
?>
<main class="register container-fluid d-flex align-items-center justify-content-center">
    <div class="wrapper px-4 py-3">
        <h2 class="title mt-2 py-1 text-center">Add agri officer</h2>
        <br>
        <form class=" mt-2 mb-1 px-2" action="" method="post">
            <div class="row gap-2">
                <?php
                $formData = [
                    "nic" => [
                        "element" => InputField::class,
                        "wrapperClass" => "col-4",
                        "label" => "NIC",
                        "placeholder" => "Enter agri-officer's NIC",
                    ],
                    "full_name" => [
                        "element" => InputField::class,
                        "wrapperClass" => "col-8",
                        "label" => "Full Name",
                        "placeholder" => "Enter agri-officer's name",
                    ],
                    "address" => [
                        "element" => InputField::class,
                        "wrapperClass" => "col-10",
                        "label" => "Address",
                        "placeholder" => "Enter agri-officer's address",
                    ],
                    "district" => [
                        "element" => SelectField::class,
                        "wrapperClass" => "col-2",
                        "label" => "District",
                        "placeholder" => "Choose a district",
                    ],
                    "contactNo" => [
                        "element" => InputField::class,
                        "wrapperClass" => "col-4",
                        "label" => "Contact number",
                        "placeholder" => "Enter Contact No",
                    ],
                    "email" => [
                        "element" => InputField::class,
                        "wrapperClass" => "col-8",
                        "label" => "Email Address",
                        "placeholder" => "Enter Agri-Officer's Email",
                    ],
                    "password" => [
                        "element" => InputField::class,
                        "wrapperClass" => "col-4",
                        "label" => "Enter default password",
                        "placeholder" => "Enter password",
                    ],
                    "confirm_password" => [
                        "element" => InputField::class,
                        "wrapperClass" => "col-4",
                        "label" => "Confirm Password",
                        "placeholder" => "ReEnter Password",
                    ],
                ];
                $this->generateFormFields($formData);
                ?>
            </div>
            <?php if (isset($this->error)) { ?>
                <br>
                <div class="alert"><?php echo $this->error; ?></div>
            <?php } ?>
            <div class="mb-3 text-center">
                <button class="btn-lg btn-primary-light mt-3 mx-2 text-center text-white"
                        type="submit" name="submit_page_1"
                        value="register">Submit
                </button>
                <button class="btn-lg btn-outlined-error mt-3 mx-2 text-center"
                        type="reset" name="cancel"
                        value="cancel">Cancel
                </button>
            </div>
        </form>

    </div>
</main>
</body>
<?php
include APP_ROOT . "/views/inc/components/Footer.php"
?>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
?>

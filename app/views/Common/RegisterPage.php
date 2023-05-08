<?php

use app\views\inc\components\InputField;
use app\views\inc\components\SelectField;

include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto">
<?php
include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
?>
<main class="register container-fluid d-flex align-items-center justify-content-center">
    <div class="wrapper px-4 py-3 mt-5">
        <h1 class="title mt-2 py-1 text-center">Register</h1>
        <h3 class="text-center pt-1 text-grey-dark mb-3 pb-2">
            Registration for agricultural producers and manufacturers</h3>
        <div id="multi-step-form-container" class="my-3 mx-2 pt-1">
            <!-- Form Steps / Progress Bar -->
            <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0 mb-4">
            </ul>
            <!-- Step Wise Form Content -->
            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                <!-- Role selection step -->
                <section id="step-0" class="form-step">
                    <h3 class="form-section-title text-center mb-1">Select your preferred role</h3>
                    <div class="row gap-2 justify-content-center">
                        <div class="col-3">
                            <label class="px-2" title="Direct producers in the agri-sector, such as farmers">
                                <input type="radio" name="role" class="card-input-element" value="Producer" <?php
                                if (isset($this->fields['role']) && $this->fields['role'] == 'Producer') {
                                    echo 'checked';
                                }
                                ?>/>
                                <div class="card-input">
                                    Producer
                                </div>
                            </label>
                        </div>
                        <div class="col-3">
                            <label class="px-2" title="Value adding organisations and re-sellers in the agri-sector">
                                <input type="radio" name="role" class="card-input-element" value="Manufacturer" <?php
                                if (isset($this->fields['role']) && $this->fields['role'] == 'Manufacturer') {
                                    echo 'checked';
                                }
                                ?>/>
                                <div class="card-input">
                                    Manufacturer
                                </div>
                            </label>
                        </div>
                    </div m nam>
                    <?php if (isset($this->fieldErrors['role'])) { ?>
                        <div class="error mb-3"><?php echo $this->fieldErrors['role'] ?></div>
                    <?php } ?>
                    <div class="mt-2 text-center">
                        <button class="button btn-navigate-form-step" type="button" id="next-btn-0">Next
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.75 8H1.25" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M11.75 15L18.75 8L11.75 1" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </section>
                <!-- Producer steps -->
                <section id="step-11" class="form-step d-none">
                    <!--                    <h3 class="form-section-title text-center mb-1">Personal / Company details</h3>-->
                    <div class="row gap-2">
                        <?php
                        $formData = [
                            "p_name" => [
                                "element" => InputField::class,
                                "wrapperClass" => "col-8",
                                "label" => "Name",
                                "placeholder" => "Enter your name",
                                "type" => "text",
                            ],
                            "p_nic" => [
                                "element" => InputField::class,
                                "wrapperClass" => "col-4",
                                "label" => "National Identity Card no.",
                                "placeholder" => "Enter your NIC no.",
                                "type" => "text",
                            ],
                            "p_address" => [
                                "element" => InputField::class,
                                "wrapperClass" => "col-9",
                                "label" => "Address",
                                "placeholder" => "Enter your residential address",
                                "type" => "text",
                            ],
                            "p_district" => [
                                "element" => SelectField::class,
                                "wrapperClass" => "col-3",
                                "label" => "District",
                                "placeholder" => "Select district",
                            ],
                            "p_contact_no" => [
                                "element" => InputField::class,
                                "wrapperClass" => "col-4",
                                "label" => "Contact no.",
                                "placeholder" => "Enter mobile no. with +94",
                                "type" => "text",
                            ],
                            "p_email_address" => [
                                "element" => InputField::class,
                                "wrapperClass" => "col-8",
                                "label" => "Email address",
                                "placeholder" => "Enter your email address",
                                "type" => "email",
                            ],
                        ];

                        $this->generateFormFields($formData);
                        ?>
                    </div>
                    <div class="mt-3 text-center">
                        <button class="button btn-navigate-form-step btn-outline prev-btn" type="button"
                                step_number="0">
                            <svg class="pr-1" width="20" height="17" viewBox="0 0 20 17" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.53282 8.71365H19.0328" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.53282 1.71365L1.53282 8.71365L8.53282 15.7137" stroke-width="2.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Previous
                        </button>
                        <button class="button btn-navigate-form-step" type="button" step_number="12" id="next-btn-11">
                            Next
                            <svg class="pl-1" width="20" height="16" viewBox="0 0 20 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.75 8H1.25" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M11.75 15L18.75 8L11.75 1" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </section>
                <section id="step-12" class="form-step d-none">
                    <!--                    <h3 class="form-section-title text-center mb-1">Personal / Company details</h3>-->
                    <div class="row gap-2 mb-2 pb-1 justify-content-center">
                        <div class="otp-wrapper email col-12 col-6-lg px-4 mb-1">
                            <h3 class="fw-bold">Verify your email address</h3>
                            <br>
                            <div class="loading justify-content-center align-items-center d-flex mt-3 mb-2 d-none">
                                <svg width="48" height="48" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <style>.spinner_7mtw {
                                            transform-origin: center;
                                            animation: spinner_jgYN .6s linear infinite
                                        }

                                        @keyframes spinner_jgYN {
                                            100% {
                                                transform: rotate(360deg)
                                            }
                                        }</style>
                                    <path class="spinner_7mtw"
                                          d="M2,12A11.2,11.2,0,0,1,13,1.05C12.67,1,12.34,1,12,1a11,11,0,0,0,0,22c.34,0,.67,0,1-.05C6,23,2,17.74,2,12Z"/>
                                </svg>
                            </div>
                            <div class="body d-none">
                                <p class="mt-1 mb-2">We have sent a verification code to
                                    <br>
                                    <strong>sandulrenuja@gmail.com</strong>
                                    <br>
                                    Please enter the code below to verify your email address.
                                </p>
                                <br>
                                <div class="otp-field email-otp text-center">
                                    <input type="text" maxlength="1"/>
                                    <input type="text" maxlength="1"/>
                                    <input type="text" maxlength="1"/>
                                    <input type="text" maxlength="1"/>
                                    <input type="text" maxlength="1"/>
                                    <input type="text" maxlength="1"/>
                                </div>
                                <input type="text" hidden disabled name="email_otp">
                                <input type="number" hidden disabled name="email_otp_id">
                                <button type="button" class="cancel-otp email d-none" onclick="clearEmailOtp()">Clear
                                </button>
                            </div>
                        </div>

                        <div class="otp-wrapper phone col-12 col-6-lg px-4 mb-1 border-left d-none">
                            <h3 class="fw-bold">Verify your phone number</h3>
                            <br>
                            <p class="mt-1 mb-2">We have sent a verification code to
                                <br>
                                <strong>+94775415464</strong>
                                <br>
                                Please enter the code below to verify your phone no.
                            </p>
                            <br>
                            <div class="otp-field phone-otp text-center">
                                <input type="text" maxlength="1"/>
                                <input type="text" maxlength="1"/>
                                <input type="text" maxlength="1"/>
                                <input type="text" maxlength="1"/>
                                <input type="text" maxlength="1"/>
                                <input type="text" maxlength="1"/>
                            </div>
                        </div>

                    </div>
                    <div class="mt-3 text-center">
                        <button class="button btn-navigate-form-step btn-outline prev-btn" type="button"
                                step_number="11">
                            <svg class="pr-1" width="20" height="17" viewBox="0 0 20 17" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.53282 8.71365H19.0328" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.53282 1.71365L1.53282 8.71365L8.53282 15.7137" stroke-width="2.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Previous
                        </button>
                        <button class="button btn-navigate-form-step" type="button" step_number="13" id="next-btn-12">
                            Next
                            <svg class="pl-1" width="20" height="16" viewBox="0 0 20 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.75 8H1.25" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M11.75 15L18.75 8L11.75 1" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </section>
                <section id="step-13" class="form-step d-none">
                    <!-- <h3 class="form-section-title text-center mb-1">Personal / Company details</h3>-->
                    <div class="row gap-2 py-2">
                        <div class="col-6 col-lg-6 justify-content-center align-items-center m-auto text-center pt-4">
                            <input type="file" name="image" class="avatar-input" accept="image/*"/>
                            <div class="avatar-preview mb-2">
                                <div class="avatar"></div>
                                <button
                                        type="button"
                                        class="avatar-select"
                                        aria-labelledby="image"
                                        aria-describedby="image"
                                >
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.5833 3.25H5.41667C4.22005 3.25 3.25 4.22005 3.25 5.41667V20.5833C3.25 21.78 4.22005 22.75 5.41667 22.75H20.5833C21.78 22.75 22.75 21.78 22.75 20.5833V5.41667C22.75 4.22005 21.78 3.25 20.5833 3.25Z"
                                              stroke="white" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path d="M9.20837 10.8333C10.1058 10.8333 10.8334 10.1057 10.8334 9.20825C10.8334 8.31079 10.1058 7.58325 9.20837 7.58325C8.31091 7.58325 7.58337 8.31079 7.58337 9.20825C7.58337 10.1057 8.31091 10.8333 9.20837 10.8333Z"
                                              stroke="white" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path d="M22.75 16.2499L17.3333 10.8333L5.41663 22.7499" stroke="white"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>


                                </button>
                            </div>
                            <button class="btn-outlined-primary-dark btn-sm mt-4 py-1 px-2 avatar-upload">Upload
                            </button>
                        </div>

                        <div class="col-6 col-lg-6 px-4 pt-2 pb-3 m-auto border-left">
                            <div class="pl-4 pr-2">
                                <div class="mt-1">
                                    <h3 class="fw-bold mb-1 user-name"></h3>
                                    <h4 class="fw-bold text-secondary user-info"></h4>
                                </div>
                                <div class="passwords gap-2">
                                    <?php
                                    $formData = [
                                        "p_password" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-12",
                                            "label" => "Password",
                                            "placeholder" => "Create a new password",
                                            "type" => "password",
                                        ],
                                        "p_confirm_password" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-12",
                                            "label" => "Confirm password",
                                            "placeholder" => "Re-enter new password",
                                            "type" => "password",
                                        ],
                                    ];

                                    $this->generateFormFields($formData);
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <button class="button btn-navigate-form-step btn-outline prev-btn" type="button"
                                step_number="12">
                            <svg class="pr-1" width="20" height="17" viewBox="0 0 20 17" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.53282 8.71365H19.0328" stroke-width="2.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.53282 1.71365L1.53282 8.71365L8.53282 15.7137" stroke-width="2.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Previous
                        </button>
                        <button class="button btn-navigate-form-step fw-bold" type="button" id="next-btn-13">
                            <svg class="pr-1" width="20" height="17" viewBox="0 0 20 14" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.3672 1.56592L6.36729 12.5659L1.36719 7.56592"/>
                            </svg>

                            Submit
                        </button>
                    </div>
                </section>
                <!-- Manufacturer steps -->
                <section id="step-21" class="form-step d-none">
                    <!-- <h3 class="form-section-title text-center mb-1">Personal / Company details</h3>-->
                    <div class="row gap-2">
                        <div class="col-6">
                            <label for="name">Personal name / Company name</label>
                            <input type="text" id="name" name="name" placeholder="Enter personal name / company name"
                                   value="<?php
                                    if (isset($this->fields['name'])) {
                                        echo $this->fields['name'];
                                    }
                                    ?>">
                            <?php if (isset($this->fieldErrors['name'])) { ?>
                                <div class="error"><?php echo $this->fieldErrors['name']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-6">
                            <label for="nic/br">NIC / Business Registration no.</label>
                            <input type="text" id="nic/br" name="nic/br" placeholder="Enter NIC / BR no."
                                   value="<?php
                                    if (isset($this->fields['nic/br'])) {
                                        echo $this->fields['nic/br'];
                                    }
                                    ?>">
                            <?php if (isset($this->fieldErrors['nic/br'])) { ?>
                                <div class="error"><?php echo $this->fieldErrors['nic/br']; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row gap-2">
                        <div class="col-9">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address"
                                   placeholder="Enter personal address / company address"
                                   value="<?php
                                    if (isset($this->fields['address'])) {
                                        echo $this->fields['address'];
                                    }
                                    ?>">
                            <?php if (isset($this->fieldErrors['address'])) { ?>
                                <div class="error"><?php echo $this->fieldErrors['address']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-3">
                            <label for="district">District</label>
                            <input type="text" id="district" name="district" placeholder="Enter district"
                                   value="<?php
                                    if (isset($this->fields['district'])) {
                                        echo $this->fields['district'];
                                    }
                                    ?>">
                            <?php if (isset($this->fieldErrors['district'])) { ?>
                                <div class="error"><?php echo $this->fieldErrors['district']; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row gap-2">
                        <div class="col-4">
                            <label for="contact_no">Contact no.</label>
                            <input type="text" id="contact_no" name="contact_no"
                                   placeholder="Enter contact no."
                                   value="<?php
                                    if (isset($this->fields['contact_no'])) {
                                        echo $this->fields['contact_no'];
                                    }
                                    ?>">
                            <?php if (isset($this->fieldErrors['contact_no'])) { ?>
                                <div class="error"><?php echo $this->fieldErrors['contact_no']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-8">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" placeholder="Enter email address"
                                   value="<?php
                                    if (isset($this->fields['email'])) {
                                        echo $this->fields['email'];
                                    }
                                    ?>">
                            <?php if (isset($this->fieldErrors['email'])) { ?>
                                <div class="error"><?php echo $this->fieldErrors['email']; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if (isset($this->fieldErrors['role'])) { ?>
                        <div class="error mb-3"><?php echo $this->fieldErrors['role'] ?></div>
                    <?php } ?>
                    <div class="mt-3 text-center">
                        <button class="button btn-navigate-form-step btn-outline prev-btn" type="button"
                                step_number="0">Prev
                        </button>
                        <button class="button btn-navigate-form-step" type="button" step_number="22" id="next-btn-21">
                            Next
                        </button>
                    </div>
                </section>
                <section id="step-22" class="form-step d-none">
                    <h2 class="font-normal">Personal Details</h2>
                    <!-- Step 3 input fields -->
                    <div class="mt-3">
                        Step 3 input fields goes here..
                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step prev-btn" type="button" step_number="2">Prev
                        </button>
                        <button class="button submit-btn" type="submit" id="next-btn-22">Save</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
</main>
<script src="<?php echo URL_ROOT ?>/public/js/registration.js" defer></script>
</body>
<?php
include APP_ROOT . "/views/inc/components/Footer.php"
?>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
?>

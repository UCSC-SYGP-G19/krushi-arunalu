<?php
include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-hidden">
<?php
include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
?>
<main class="register_customer row d-flex align-items-center justify-content-center">
    <form class="col-6 wrapper px-4 py-3 mt-5 checkbox d-flex align-items-center">
        <div class="col-5 justify-content-center">
            <img src="<?php echo URL_ROOT ?>
            /public/img/register-customer-page/reg-customer.png" alt="Customer-reg graphic"
                 height="auto" class="p-">
        </div>
        <div class="col-7 px-4 mt-2 ml-2">
            <h1 class="title text-center">Register</h1>
            <br>
            <form class="mb-1" action="" method="post">
                <div class="form__group">
                    <input type="text" id="name" name="email/phone"
                           placeholder="Enter personal name / company name"
                           value="<?php
                           if (isset($this->fields['name'])) {
                                echo $this->fields['name'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['name'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['name']; ?></div>
                    <?php } ?>
                </div>
                <div>
                    <input type="text" id="contact_no" name="contact_no" placeholder="Enter contact no."
                           value="<?php
                            if (isset($this->fields['contact_no'])) {
                                echo $this->fields['contact_no'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['contact_no'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['contact_no']; ?></div>
                    <?php } ?>
                </div>

                <div>
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
                <div class="checkbox d-flex align-items-center justify-content-center ">
                    <div class="col-6">
                        <input type="password" id="password" name="password" placeholder="Create a new password"
                               value="<?php
                                if (isset($this->fields['password'])) {
                                    echo $this->fields['password'];
                                }
                                ?>">
                        <?php if (isset($this->fieldErrors['password'])) { ?>
                            <div class="error"><?php echo $this->fieldErrors['password']; ?></div>
                        <?php } ?>
                    </div>
                    <div class="col-6 ">
                        <input type="password" id="confirm_password" name="confirm_password"
                               placeholder="Re-enter password"
                               value="<?php
                                if (isset($this->fields['confirm_password'])) {
                                    echo $this->fields['confirm_password'];
                                }
                                ?>">
                        <?php if (isset($this->fieldErrors['confirm_password'])) { ?>
                            <div class="error"><?php echo $this->fieldErrors['confirm_password']; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <input type="checkbox" id="t&c" name="t&c" value="t&c_accepted">
                    <?php if (isset($this->fields['t&c']) && $this->fields['t&c'] == 't&c_accepted') {
                            echo 'checked';
                        } ?>
                    <label for="t&c" class="check"> I agree to the <a href="#">Terms and Conditions</a>
                    </label>
                    <?php if (isset($this->fieldErrors['t&c'])) { ?>
                            <div class="error"><?php echo $this->fieldErrors['t&c']; ?></div>
                        <?php } ?> <?php if (isset($this->error)) { ?>
                            <div class="alert"><?php echo $this->error; ?></div>
                        <?php } ?>
                </div>
                <div class="mt-2 mb-3 text-center">
                    <button class="btn-primary-light mt-3 text-center text-white" type="submit" name="register"
                            value="register">REGISTER
                    </button>
                </div>
        </div>
    </form>
</main>
</body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
?>




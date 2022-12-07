<?php
include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto">
<?php
include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
?>
<main class="register container-fluid d-flex align-items-center justify-content-center">
    <div class="wrapper px-4 py-3 mt-5">
        <h1 class="title mt-2 py-1 text-center">Register</h1>
        <h3 class="text-center pt-1 text-grey-dark">Registration for agricultural producers and manufacturers</h3>
        <br>
        <form class="mb-1 px-2" action="" method="post">
            <h3 class="form-section-title">Personal / Company details</h3>
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
            <h3 class="form-section-title">Login details</h3>
            <div class="row gap-2">
                <div class="col-6">
                    <label for="password">Password</label>
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
                <div class="col-6">
                    <label for="confirm_password">Confirm password</label>
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
            <h3 class="form-section-title">User role selection</h3>
            <div class="row gap-2 justify-content-center mb-1">
                <div class="col-3">
                    <label class="px-2">
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
                    <label class="px-2">
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
            </div>
            <?php if (isset($this->fieldErrors['role'])) { ?>
                <div class="error mb-3"><?php echo $this->fieldErrors['role'] ?></div>
            <?php } ?>
            <div class="row justify-content-start mt-2">
                <div class="col-12">
                    <input type="checkbox" id="t&c" name="t&c" value="t&c_accepted" <?php
                    if (isset($this->fields['t&c']) && $this->fields['t&c'] == 't&c_accepted') {
                        echo 'checked';
                    }
                    ?>>
                    <label for="t&c" class="fs-3 d-inline px-2">
                        I agree to the <a href="#">Terms and Conditions</a>
                    </label>
                </div>
            </div>
            <?php if (isset($this->fieldErrors['t&c'])) { ?>
                <div class="error mt-3 mb-1"><?php echo $this->fieldErrors['t&c'] ?></div>
            <?php } ?>
            <?php if (isset($this->error)) { ?>
                <br>
                <div class="alert"><?php echo $this->error; ?></div>
            <?php } ?>
            <div class="mt-1 mb-3 text-center">
                <button class="btn-lg btn-primary-light mt-3 text-center text-white" type="submit" name="register"
                        value="register">REGISTER
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

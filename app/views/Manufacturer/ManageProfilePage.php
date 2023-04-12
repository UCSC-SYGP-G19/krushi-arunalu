<?php
include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto">
<?php
include APP_ROOT . "/views/inc/components/LoggedInNavbarWithoutSidebar.php"
?>
<main class="register container-fluid d-flex align-items-center justify-content-center">
    <div class="wrapper px-4 py-3">
        <h2 class="title mt-2 py-1 text-center">Manage Profile</h2>
        <br>
        <form class="mb-1 px-2" action="" method="post">
            <h3 class="form-section-title">Company details</h3>
            <div class="row gap-2">
                <div class="col-3">
                    <label for="logo">Upload Logo</label>
                    <div class="image-upload py-2">
                        <div class="upload-content">
                            <div class="upload-icon pt-2 pb-1">
                                <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                     viewBox="0 0 50 50">
                                <path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7
                                 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5
                                  6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1
                                   8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7
                                    1.7 0 2.4l10 11.6z">
                                    </path></svg>
                            </div>
                            <span class="txt-drag">Drag & Drop</span>
                            <span>OR</span>
                            <button class="btn-browse" type="button">Browse</button><br>
                        </div>
                        <div class="image-preview d-none"></div>
                        <input type="file" hidden class="upload-input" id="logo" name="logo" accept="image/*"/>
                        <button class="btn-xs btn-outlined-secondary mb-2">Upload</button>
                    </div>
                    <?php if (isset($this->fieldErrors['logo'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['logo']; ?></div>
                    <?php } ?>
                </div>

                <div class="col-9">
                    <label for="store_cover">Upload store cover</label>
                    <div class="image-upload pt-2 pb-3">
                        <div class="upload-content">
                            <div class="upload-icon pt-1 pb-1">
                                <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                     viewBox="0 0 50 50">
                                <path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7
                             1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5
                              6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1
                               8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7
                                1.7 0 2.4l10 11.6z">
                                </path></svg>
                            </div>
                            <header class="txt-drag">Drag & Drop</header>
                            <span>OR</span>
                            <button class="btn-browse" type="button">Browse</button><br>
                        </div>
                        <div class="image-preview mb-2"></div>
                        <input type="file" hidden class="upload-input" id="store_cover" name="store_cover"
                               accept="image/*"/>
                        <button class="btn-outlined-secondary btn-upload">Upload</button>
                    </div>
                    <?php if (isset($this->fieldErrors['store_cover'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['store_cover']; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="row gap-2">
                <div class="col-6">
                    <label for="company_name">Company name</label>
                    <input type="text" id="company_name" name="company_name"
                           placeholder="Enter company name"
                           value="<?php
                            if (isset($this->fields['company_name'])) {
                                echo $this->fields['company_name'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['company_name'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['company_name']; ?></div>
                    <?php } ?>
                </div>
                <div class="col-6">
                    <label for="br_no">Business Registration number</label>
                    <input type="text" id="br_no" name="br_no"
                           placeholder="Enter BR No"
                           value="<?php
                            if (isset($this->fields['br_no'])) {
                                echo $this->fields['br_no'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['br_no'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['br_no']; ?></div>
                    <?php } ?>
                </div>
            </div>

            <div class="row gap-2">
                <div class="col-9">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address"
                           placeholder="Enter company address"
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
                    <select name="district" id="district">
                        <option value="" selected>Select district</option>
                        <?php foreach ($this->fieldOptions["district"] as $option) {
                            echo '<option value="' . $option->getId() . '"' .
                                ($this->fields['district'] == $option->getId() ? 'selected' : '')
                                . '>' . $option->getName() . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row gap-2">
                <div class="col-4">
                    <label for="contact_no">Contact number</label>
                    <input type="text" id="contact_no" name="contact_no"
                           placeholder="Enter contact no"
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
                    <input type="email" id="email" name="email"
                           placeholder="Enter email address"
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
                <div class="col-4">
                    <label for="c_password">Current password</label>
                    <input type="password" id="c_password" name="c_password"
                           placeholder="Enter current password"
                           value="<?php
                            if (isset($this->fields['c_password'])) {
                                echo $this->fields['c_password'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['c_password'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['c_password']; ?></div>
                    <?php } ?>
                </div>
                <div class="col-4">
                    <label for="n_password">New password</label>
                    <input type="password" id="n_password" name="n_password"
                           placeholder="Enter new password"
                           value="<?php
                            if (isset($this->fields['n_password'])) {
                                echo $this->fields['n_password'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['n_password'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['n_password']; ?></div>
                    <?php } ?>
                </div>
                <div class="col-4">
                    <label for="cn_password">Confirm new password</label>
                    <input type="password" id="cn_password" name="cn_password"
                           placeholder="Confirm new password"
                           value="<?php
                            if (isset($this->fields['cn_password'])) {
                                echo $this->fields['cn_password'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['cn_password'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['cn_password']; ?></div>
                    <?php } ?>
                </div>
            </div>
            <?php if (isset($this->error)) { ?>
                <br>
                <div class="alert"><?php echo $this->error; ?></div>
            <?php } ?>
            <div class="mb-3 text-center">
                <button class="btn-lg btn-primary-light mt-3 text-center text-white" type="submit" name="update_profile"
                        value="update">Update
                </button>
                <button class="btn-lg btn-outlined-error mt-3 text-center text-error" type="reset"
                        name="reset_profile_details" value="cancel">Cancel
                </button>
            </div>
        </form>
    </div>
</main>
<?php echo '<script defer src="' . URL_ROOT . '/public/js/imageUploader.js"' . '></script>' ?>

</body>
<?php
include APP_ROOT . "/views/inc/components/Footer.php"
?>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
?>

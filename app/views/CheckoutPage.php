<?php
include APP_ROOT . "/views/inc/components/Header.php";

?>
<?php

//if (isset($this->user)) {
//    echo "Logged in as: " . $this->user->getName() . " (" . $this->user->getRole() . ")<br>";
//    echo "<a href='./logout'>Logout</a>";
//} else {
//    echo "You are not logged in, please <a href='./login'>login</a>";
//}
//


?>

    <body class="overflow-hidden full-height">
    <?php
    //include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
    ?>
    <div class="content-with-sidebar">
        <?php
        include APP_ROOT . "/views/inc/components/Sidebar.php"
        ?>
        <main class="content overflow-y-auto">
            <?php
            include APP_ROOT . "/views/inc/components/LoggedInNavbar.php"
            ?>

            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 pt-1 justify-content-space-between">
                            <div class="col-12 px-10 pt-2">
                                <h1 class="title">Checkout</h1>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <form class="mb-1 px-2" action="" method="post">
                                <div class="row gap-2">
                                    <div class="col-12">
                                        <label for="name">Recipient name</label>
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
                                        <label for="nic/br">Delivery address</label>
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
                                        <label for="address">Postal code</label>
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
                                        <label for="district">Country</label>
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
                                <div class="row gap-2">
                                    <label for="nic/br">Delivery Instructions (optional)</label>
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
                                <label for="nic/br">Select payment method</label>
                                <div class="row gap-2 justify-content-center mb-1">
                                    <div class="col-3">
                                        <label class="px-2">
                                            <input type="radio" name="role" class="card-input-element" value="Producer" <?php
                                            if (isset($this->fields['role']) && $this->fields['role'] == 'Producer') {
                                                echo 'checked';
                                            }
                                            ?>/>
                                            <div class="card-input">
                                                Credit/Debit Card
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
                                                Cash on Delivery
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="row gap-2 justify-content-center mb-1">
                                    <label for="district">Amount paid</label>
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
                                <div class="mt-1 mb-3 text-center">
                                    <button class="btn-lg btn-primary-light mt-3 text-center text-white" type="submit" name="register"
                                            value="register">Place order
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include APP_ROOT . "/views/inc/components/Footer.php";
            ?>

        </main>
    </div>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


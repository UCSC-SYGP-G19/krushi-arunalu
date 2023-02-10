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
                                <h1 class="title px-2">Checkout</h1>
                            </div>
                        </div>

                        <form class="mb-1 px-2" action="checkout/confirm" method="post">
                            <div class="row px-1 pt-2">
                                <div class="col-12 p-2 ">

                                    <label for="recipient_name">Recipient name</label>
                                    <input type="text" id="recipient_name" name="recipient_name"
                                           placeholder="Enter recipient name"
                                           value="<?php
                                            if (isset($this->fields['recipient_name'])) {
                                                echo $this->fields['recipient_name'];
                                            }
                                            ?>">
                                    <?php if (isset($this->fieldErrors['recipient_name'])) { ?>
                                        <div class="error"><?php echo $this->fieldErrors['recipient_name']; ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-7 p-2">
                                    <label for="contact_no">Contact no.</label>
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
                                <div class="col-5 p-2">
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
                                <div class="col-12 p-2">
                                    <label for="nic/br">Delivery address</label>
                                    <input type="text" id="delivery_address" name="delivery_address"
                                           placeholder="Enter delivery address"
                                           value="<?php
                                            if (isset($this->fields['nic/br'])) {
                                                echo $this->fields['nic/br'];
                                            }
                                            ?>">
                                    <?php if (isset($this->fieldErrors['nic/br'])) { ?>
                                        <div class="error"><?php echo $this->fieldErrors['nic/br']; ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-9 p-2">
                                    <label for="address">Postal code</label>
                                    <input type="text" id="postalCode" name="postal_code"
                                           placeholder="Enter postal code"
                                           value="<?php
                                            if (isset($this->fields['postalCode'])) {
                                                echo $this->fields['postalCode'];
                                            }
                                            ?>">
                                    <?php if (isset($this->fieldErrors['postalCode'])) { ?>
                                        <div class="error"><?php echo $this->fieldErrors['postalCode']; ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-3 p-2">
                                    <label for="country">Country</label>
                                    <select name='country' id='country'>
                                        <option value='Sri Lanka' selected>Sri Lanka</option>
                                        <option value='India'>India</option>
                                        <option value='China'>China</option>
                                        <option value='Japan'>Japan</option>
                                        <option value='North Korea'>North Korea</option>
                                    </select>
                                    <?php if (isset($this->fieldErrors['district'])) { ?>
                                        <div class="error"><?php echo $this->fieldErrors['district']; ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-12 p-2">
                                    <label for="delivery_instructions">Delivery instructions</label>
                                    <input type="text" id="delivery_instructions" name="delivery_instructions"
                                           placeholder="Enter delivery instructions"
                                           value="<?php
                                            if (isset($this->fields['nic/br'])) {
                                                echo $this->fields['nic/br'];
                                            }
                                            ?>">
                                    <?php if (isset($this->fieldErrors['nic/br'])) { ?>
                                        <div class="error"><?php echo $this->fieldErrors['nic/br']; ?></div>
                                    <?php } ?>
                                </div>
                                <div class="col-12 p-2">
                                    <label for="nic/br">Select payment method</label>
                                    <div class="row gap-1 justify-content-center mb-1">
                                        <div class="col-3">
                                            <label class="px-2">
                                                <input type="radio" name="role" class="card-input-element"
                                                       value="Producer" <?php
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
                                                <input type="radio" name="role" class="card-input-element"
                                                       value="Manufacturer" <?php
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
                                    <div class="row justify-content-center mb-1">
                                        <div class="col-4 p-2">
                                            <!--    <label for="district">Amount paid</label>-->
                                            <input type="number" id="amount_paid" name="amount_paid"
                                                   placeholder="Enter paid amount"
                                                   value="<?php
                                                    if (isset($this->fields['amount_paid'])) {
                                                        echo $this->fields['amount_paid'];
                                                    }
                                                    ?>">
                                            <?php if (isset($this->fieldErrors['amount_paid'])) { ?>
                                                <div class="error"><?php echo $this->fieldErrors['amount_paid']; ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1 mb-3 text-center justify-content-center">
                                <a class="btn-lg btn-primary-light mt-3 text-center text-white "
                                        href="<?php echo URL_ROOT ?>/checkout/orderConfirm">
                                    Place order
                                </a>
                            </div>
                        </form>

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


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
    <div class="content-with-sidebar checkout-page">
        <?php
        include APP_ROOT . "/views/inc/components/Sidebar.php"
        ?>
        <main class="content overflow-y-auto">
            <?php
            include APP_ROOT . "/views/inc/components/CustomerLoggedInNavbar.php"
            ?>

            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 pt-1 mb-2 justify-content-space-between">
                            <div class="col-12 px-10 pt-2">
                                <h1 class="title px-2">Checkout</h1>
                            </div>
                        </div>

                        <form class="mb-3 mt-4 px-2 py-3 px-4 m-2" action="checkout/confirm" method="POST">
                            <div class="row px-1 pt-1 mb-2 justify-content-center">
                                <div class="row px-1 pt-1 mb-2 justify-content-end">
                                    <div class="col-12 px-10 pt-2">
                                        <h2 class="title px-2 order-total"><span
                                                    class="fw-normal">Order total:&ensp;</span>
                                            <span class="fw-bold fs-3"></span>Rs. <?php echo number_format($this->data["orderTotal"], 2) ?></span>
                                        </h2>
                                        <input type="text" value="<?php echo $this->data["orderTotal"] ?>"
                                               name="order_total" hidden>
                                    </div>
                                </div>
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
                                               if (isset($this->fields['delivery_address'])) {
                                                   echo $this->fields['delivery_address'];
                                               }
                                               ?>">
                                        <?php if (isset($this->fieldErrors['delivery_address'])) { ?>
                                            <div class="error"><?php echo $this->fieldErrors['delivery_address']; ?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-9 p-2">
                                        <label for="address">Postal code</label>
                                        <input type="text" id="postalCode" name="postal_code"
                                               placeholder="Enter postal code"
                                               value="<?php
                                               if (isset($this->fields['postal_code'])) {
                                                   echo $this->fields['postal_code'];
                                               }
                                               ?>">
                                        <?php if (isset($this->fieldErrors['postal_code'])) { ?>
                                            <div class="error"><?php echo $this->fieldErrors['postal_code']; ?></div>
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
                                        <?php if (isset($this->fieldErrors['country'])) { ?>
                                            <div class="error"><?php echo $this->fieldErrors['country']; ?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-12 p-2">
                                        <label for="delivery_instructions">Delivery instructions</label>
                                        <input type="text" id="delivery_instructions" name="delivery_instructions"
                                               placeholder="Enter delivery instructions"
                                               value="<?php
                                               if (isset($this->fields['delivery_instructions'])) {
                                                   echo $this->fields['delivery_instructions'];
                                               }
                                               ?>">
                                        <?php if (isset($this->fieldErrors['delivery_instructions'])) { ?>
                                            <div class="error"><?php echo $this->fieldErrors['delivery_instructions']; ?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-12 p-2">
                                        <label for="nic/br">Select payment method</label>
                                        <div class="row gap-1 justify-content-center mb-1">
                                            <div class="col-3">
                                                <label class="px-2">
                                                    <input type="radio" name="payment_method" class="card-input-element"
                                                           value="CARD" <?php
                                                    if (isset($this->fields['payment_method']) && $this->fields['payment_method'] == 'CARD') {
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
                                                           value="CASH" <?php
                                                    if (isset($this->fields['payment_method']) && $this->fields['payment_method'] == 'CASH') {
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
                                    <!--                                <a class="btn-lg btn-primary-light mt-3 text-center text-white "-->
                                    <!--                                        href="-->
                                    <?php //echo URL_ROOT ?><!--/checkout/confirm">-->
                                    <!--                                    Place order-->
                                    <!--                                </a>-->
                                    <button type="submit" class="btn-lg btn-primary-light mt-3 text-center text-white ">
                                        Place order
                                    </button>
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


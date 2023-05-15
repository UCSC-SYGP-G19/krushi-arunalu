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
    <div class="content-with-sidebar shopping-cart">
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
                        <div class="row px-1 pt-1 justify-content-space-between">
                            <div class="col-6">
                                <a class="btn-outlined-primary-light fw-bold fs-3"
                                   href="<?php echo URL_ROOT ?>/marketplace">
                                    &lt; Back to shopping
                                </a>
                            </div>
                            <div class="col-12 px-10 pt-3">
                                <h1 class="title">Shopping Cart</h1>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>

                                <table>
                                    <thead>
                                    <tr class="row py-3">
                                        <th class="col-1"></th>
                                        <th class="col-4">Product Name</th>
                                        <th class="col-2">Quantity</th>
                                        <th class="col-1">Unit Price</th>
                                        <th class="col-2">Amount</th>
                                        <th class="col-2"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($this->data as $cartEntry) {
                                        ?>
                                        <tr class="row px-3">
                                            <td class="col-1">
                                                <?php echo '<div class="image-window mb-1">
                                    ' . '<img class="ml-2 mt-2 px-2" alt="Product image" height="100%" 
                                                width="100%" src="' . URL_ROOT . '/public/img/products/' .
                                                    $cartEntry->product_image_url . '">' . '
                                    </div>'
                                                ?></td>
                                            <td class="col-4"><?php echo $cartEntry->product_name; ?></td>
                                            <td class="col-2"><?php echo $cartEntry->quantity_in_cart; ?></td>
                                            <td class="col-1"><?php echo $cartEntry->product_unit_selling_price ?></td>
                                            <td class="col-2"><?php echo number_format(((float)$cartEntry->product_unit_selling_price * (float)$cartEntry->quantity_in_cart), 2, '.', '') ?></td>
                                            <td class="col-2 pr-3">
                                                <div class="row justify-content-end align-items-center gap-1">
                                                    <div class="col">
                                                        <a href='<?php URL_ROOT ?>/krushi-arunalu/shopping-cart/removeEntryFromCart/<?php echo $cartEntry->shopping_cart_item_id; ?>'
                                                           class="btn-xs btn-outlined-error text-center pt-2 remove-icon">
                                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.6445 10.7782V16.7782" stroke="#D03225"
                                                                      stroke-width="1.5" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M14.6445 10.7782V16.7782" stroke="#D03225"
                                                                      stroke-width="1.5" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M18.6445 6.7782V18.7782C18.6445 19.8828 17.7491 20.7782 16.6445 20.7782H8.64453C7.53996 20.7782 6.64453 19.8828 6.64453 18.7782V6.7782"
                                                                      stroke="#D03225" stroke-width="1.5"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M4.64453 6.7782H20.6445" stroke="#D03225"
                                                                      stroke-width="1.5" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M15.6445 6.7782V5.7782C15.6445 4.67363 14.7491 3.7782 13.6445 3.7782H11.6445C10.54 3.7782 9.64453 4.67363 9.64453 5.7782V6.7782"
                                                                      stroke="#D03225" stroke-width="1.5"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr class="row table-summary-row py-3">
                                        <td class="col-8 justify-content-start"><strong>Total</strong></td>
                                        <td class="col-2"></td>
                                        <td class="col-2"></td>
                                    </tr>
                                    <!---->
                                    <!--                                    <tr class="row justify-content-end pagination">-->
                                    <!--                                        <td class="col-3 text-right"><span>Rows per page:</span><label>-->
                                    <!--                                                <select name="table_filter" id="table_filter">-->
                                    <!--                                                    <option value="">-->
                                    <?php //echo count($this->data); ?><!--</option>-->
                                    <!--                                                </select>-->
                                    <!--                                            </label></td>-->
                                    <!--                                        <td class="col-2">1--->
                                    <?php //echo count($this->data); ?><!-- of-->
                                    <!--                                            --><?php //echo count($this->data); ?>
                                    <!--                                            <span class="arrow-icons">-->
                                    <!--                                                <span class="left-arrow">-->
                                    <!--                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"-->
                                    <!--                                                         xmlns="http://www.w3.org/2000/svg">-->
                                    <!--                                                    <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"-->
                                    <!--                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"-->
                                    <!--                                                          stroke-linejoin="round"/>-->
                                    <!--                                                </svg>-->
                                    <!--                                                </span>-->
                                    <!---->
                                    <!--                                                <span class="right-arrow">-->
                                    <!--                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"-->
                                    <!--                                                         xmlns="http://www.w3.org/2000/svg">-->
                                    <!--                                                    <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"-->
                                    <!--                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"-->
                                    <!--                                                          stroke-linejoin="round"/>-->
                                    <!--                                                </svg>-->
                                    <!--                                                </span>-->
                                    <!--                                            </span>-->
                                    <!--                                        </td>-->
                                    <!--                                    -->
                                    <!--                                    -->

                                    </tfoot>
                                </table>
                                <div class="py-3 mb-2 row justify-content-center">
                                    <a class="btn-lg btn-primary-light mt-3 text-center text-white"
                                       href="<?php echo URL_ROOT ?>/checkout">
                                        Proceed to Checkout
                                    </a>
                                </div>
                            </div>
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


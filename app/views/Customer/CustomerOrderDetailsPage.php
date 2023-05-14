<?php

include APP_ROOT . "/views/inc/components/Header.php";

?>
    <body class="overflow-hidden full-height">
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
                        <div class="row pb-2">
                            <?php echo '<a class="btn-md btn-outlined-secondary text-center text-black" href = "
                                 ' . URL_ROOT . '/orders">Back to all orders</a>' ?>
                        </div>
                        <div class="row px-1 pt-1 justify-content-space-between pb-3">
                            <div class="col-6">
                                <h1 class="title">Order details</h1>
                            </div>
                            <div class="col">
                                <a href=""
                                   class="btn-md btn-outlined-primary-light text-center text-primary-light">
                                    ✓ Accepted</a>
                            </div>
                        </div>
                        <div class="order-details-wrapper col-12 d-block">
                            <div class="order-details-container col-12 d-block px-4 py-3 mb-1">
                                <div class="fw-bold col-12">Order ID: <?php
                                    echo $this->data["order-details"]->order_id;
                                ?></div>
                                <div class="col-12 text-secondary">
                                    Placed on
                                    <?php
                                    echo $this->data["order-details"]->order_date_time;
                                    ?>
                                    by <?php echo $this->data["order-details"]->order_recipient_name; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-justify">
                                    <table>
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($this->data["order-items"] as $orderItem) {
                                            ?>
                                        <tr class="row">
                                </div>
                                <td class="col-2"><?php
                                    echo '     ' . '<img alt="Product image" height="18%"
                                                         width="35%" 
                                                             src="' . URL_ROOT .
                                        '/public/img/products/' . $orderItem->product_img_url .
                                        '">';
                                ?></td>
                                <td class="col-4 pr-7"><h4><?php echo $orderItem->product_name; ?></h4>
                                            <?php echo $orderItem->product_description; ?>
                                </td>
                                <td class="col-1"><?php echo $orderItem->quantity; ?></td>
                                <td class="col-1"><?php echo $orderItem->unit_price; ?></td>
                                <td class="col-2"><?php echo $orderItem->quantity *
                                        $orderItem->
                                        unit_price; ?></td>
                                <td class="col-2"><a class="btn-outlined-tertiary "
                                                     href=<?php echo "./marketplace/" ?>>
                                        Rate
                                    </a></td>
                                </tr>
                                            <?php
                                        }
                                        ?>


                                </tbody>
                                <tfoot>
                                <tr class="row justify-content-end pagination">
                                    <td class="col-3 text-right"><span>Rows per page:</span><label>
                                            <select name="table_filter" id="table_filter">
                                                <option value="">10</option>
                                            </select>
                                        </label></td>
                                    <td class="col-2">1-2 of 25
                                        <span class="arrow-icons">
                                                <span class="left-arrow">
                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"
                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                </span>

                                                <span class="right-arrow">
                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"
                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                </span>
                                            </span>
                                    </td>
                                </tfoot>

                                </table>
                            </div>
                        </div>

                        <div class="d-flex col-12 mt-1">
                            <div class="col-6 pr-1">
                                <div class="delivery-address col-12 py-2">
                                    <h3 class="text-center pb-2">Delivery Address</h3>
                                    <hr/>
                                    <div class="col-12 pt-1 px-4">
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">Recipient name:</div>
                                            <div class="col-7">Vinuri Gamage</div>
                                        </div>
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">Address:</div>
                                            <div class="col-7">  <?php
                                            foreach ($this->data as $orderItem) {
                                                echo $orderItem->delivery_address;
                                                break;
                                            }
                                            ?></div>
                                        </div>
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">contact no:</div>
                                            <div class="col-7"><?php
                                            foreach ($this->data as $orderItem) {
                                                echo $orderItem->contact_no;
                                                break;
                                            }
                                            ?></div>
                                        </div>
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">Special instructions:</div>
                                            <div class="col-7"><?php
                                            foreach ($this->data as $orderItem) {
                                                echo $orderItem->delivery_instructions;
                                                break;
                                            }
                                            ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="order-summary col-6 py-2">
                                <h3 class="text-center pb-2">Order Summary</h3>
                                <hr/>
                                <div class="col-12 pt-1 px-4">
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">No of items:</div>
                                        <div class="col-7"><?php echo count($this->data) ?></div>
                                    </div>
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">Sub-total:</div>
                                        <div class="col-7">Rs. 3460.00</div>
                                    </div>
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">Discounts:</div>
                                        <div class="col-7">Rs. 0.00</div>
                                    </div>
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">Order total:</div>
                                        <div class="col-7">Rs. 3460.00</div>
                                    </div>
                                </div>
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


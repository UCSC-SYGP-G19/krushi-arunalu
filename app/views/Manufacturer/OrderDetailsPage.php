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
                                 ' . URL_ROOT . '/manufacturer-sales">Back to all orders</a>' ?>
                        </div>
                        <div class="row px-1 pt-1 justify-content-space-between pb-3">
                            <div class="col-6">
                                <h1 class="title">Order details</h1>
                            </div>
                            <div class="col">
                                <a href="producers/connectionRequests"
                                   class="btn-md btn-outlined-primary-light text-center text-primary-light">
                                    ✓ Accepted</a>
                            </div>
                        </div>
                        <div class="order-details-wrapper col-12 d-block">
                            <div class="order-details-container col-12 d-block px-4 py-3 mb-1">
                                <div class="fw-bold col-12">Order ID: #123456</div>
                                <div class="col-12 text-secondary">
                                    Placed on 18 Sep 2022 13:32:47 by Nimal Siripala</div>
                            </div>

                            <div class="order-items-container col-12">
                                <div class="order-item-wrapper px-4 py-3 d-flex">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="product-img">
                                                <?php echo '<img src="
                                            ' . URL_ROOT . '/public/img/products/coconut_oil.jpg"
                                            alt="User profile icon" height="56px">' ?>
                                            </div>
                                            <div class="d-block">
                                                <div class="product-name-name px-4 pt-1 fw-bold fs-3">
                                                    Coconut Oil
                                                </div>
                                                <div class="text-secondary px-4 fs-2">
                                                    Description
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 justify-content-space-between d-flex">
                                        <div class="d-block">
                                            <div class="product-name-name px-4 pt-1 fw-bold fs-3">
                                                Rs. 100.00
                                            </div>
                                            <div class="text-secondary px-4 fs-2">
                                                Unit price
                                            </div>
                                        </div>
                                        <div class="p-1">
                                            <div class="product-qty text-white fw-bold align-items-center px-2 py-1">
                                                Qty: 4</div>
                                        </div>
                                        <div class="fw-bold fs-4 py-2">Rs. 400.00</div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-items-container col-12">
                                <div class="order-item-wrapper px-4 py-3 d-flex">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="product-img">
                                                <?php echo '<img src="
                                            ' . URL_ROOT . '/public/img/products/hanging-bowl.jpg"
                                            alt="User profile icon" height="56px">' ?>
                                            </div>
                                            <div class="d-block">
                                                <div class="product-name-name px-4 pt-1 fw-bold fs-3">
                                                    Hanging Bowl
                                                </div>
                                                <div class="text-secondary px-4 fs-2">
                                                    Description
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 justify-content-space-between d-flex">
                                        <div class="d-block">
                                            <div class="product-name-name px-4 pt-1 fw-bold fs-3">
                                                Rs. 2300.00
                                            </div>
                                            <div class="text-secondary px-4 fs-2">
                                                Unit price
                                            </div>
                                        </div>
                                        <div class="p-1">
                                            <div class="product-qty text-white fw-bold align-items-center px-2 py-1">
                                                Qty: 1</div>
                                        </div>
                                        <div class="fw-bold fs-4 py-2">Rs. 2300.00</div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-items-container col-12">

                                <div class="order-item-wrapper px-4 py-3 d-flex">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="product-img">
                                                <?php echo '<img src="
                                            ' . URL_ROOT . '/public/img/products/sumudu.jpg"
                                            alt="User profile icon" height="56px">' ?>
                                            </div>
                                            <div class="d-block">
                                                <div class="product-name-name px-4 pt-1 fw-bold fs-3">
                                                    Sumudu Toothpaste
                                                </div>
                                                <div class="text-secondary px-4 fs-2">
                                                    Description
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 justify-content-space-between d-flex">
                                        <div class="d-block">
                                            <div class="product-name-name px-4 pt-1 fw-bold fs-3">
                                                Rs. 380.00
                                            </div>
                                            <div class="text-secondary px-4 fs-2">
                                                Unit price
                                            </div>
                                        </div>
                                        <div class="p-1">
                                            <div class="product-qty text-white fw-bold align-items-center px-2 py-1">
                                                Qty: 2</div>
                                        </div>
                                        <div class="fw-bold fs-4 py-2">Rs. 760.00</div>
                                    </div>
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
                                                <div class="col-7">24/A, Thalgampala, Galle</div>
                                            </div>
                                            <div class="py-1 col-12 d-flex">
                                                <div class="col-5">Contact no:</div>
                                                <div class="col-7">071-6718916</div>
                                            </div>
                                            <div class="py-1 col-12 d-flex">
                                                <div class="col-5">Special instructions:</div>
                                                <div class="col-7">None</div>
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
                                            <div class="col-7">3</div>
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


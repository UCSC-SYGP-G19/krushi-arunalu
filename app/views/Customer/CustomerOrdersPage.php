<?php
include APP_ROOT . "/views/inc/components/Header.php";

?>
<?php

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
                            <div class="col-6">
                                <h1 class="title">My Orders</h1>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <table>
                                    <thead>
                                    <tr class="row">
                                        <th class="col-2">Order ID</th>
                                        <th class="col-2">Products</th>
                                        <th class="col-2">Order Date/Time</th>
                                        <th class="col-2">Order Total</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-2">
                                        </th>
                                        <th class="col-2"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach ($this->data["orders_list"] as $orderEntry) {
                                        ?>
                                        <tr class="row">
                                            <td class="col-2"><?php echo $orderEntry->order_id; ?></td>
                                            <td class="col-2 circular-img-set">
                                                <?php foreach ($this->data["order_product_imgs"][$orderEntry->order_id] as $img) {
                                                    echo '<div class="circular-img" title = "' . $img->name . '"
                                                            style="background-image: url(' . URL_ROOT . '/public/img/products/' .
                                                        $img->image_url . ')"></div>';
                                                }
                                                ?>
                                            </td>
                                            <td class="col-2"><?php echo $orderEntry->date_time; ?></td>
                                            <td class="col-2"><?php echo $orderEntry->total_cost; ?></td>
                                            <td class="col-2"><?php echo $orderEntry->status; ?></td>
                                            <td class="col-2"><a class="btn-outlined-primary-light btn-sm m-2"
                                                                 href="customer-orders/order-details/<?php echo $orderEntry->order_id ?>">
                                                    View details</a>
                                            </td>
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


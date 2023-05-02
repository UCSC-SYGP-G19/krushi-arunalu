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
                                    foreach ($this->data as $orderEntry) {
                                        ?>
                                        <tr class="row">
<!--                                            <td class="col-1">-->
<!--                                                --><?php //echo $orderEntry->id . '">' . '
//                                            </div>' ?><!--</td>-->
                                            <td class="col-2"><?php echo $orderEntry->order_id; ?></td>
                                            <td class="col-2"><?php foreach ($this->data_1 as $orderEntry_2) {
                                                echo '     ' . '<img alt="Product image" height="18%" width="18%"
                                                             src="' . URL_ROOT .
                                                '/public/img/products/' . $orderEntry_2->product_img . '">';
                                                              } ?></td>
                                            <td class="col-2"><?php echo $orderEntry->date_time; ?></td>
                                            <td class="col-2"><?php echo $orderEntry->total_cost; ?></td>
                                            <td class="col-2"><?php echo $orderEntry->status; ?></td>
                                            <td class="col-2"><a class="btn-outlined-tertiary "
                                                                 href=<?php echo "./marketplace/"?>>
                                                    View details
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


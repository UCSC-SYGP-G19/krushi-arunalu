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
                        <div class="row px-1 pt-1 justify-content-space-between">
                            <div class="col-6">
                                <h1 class="title">Manufacturer Order</h1>
                            </div>
                            <div class="col">
                                <a href="<?php echo URL_ROOT; ?>/manufacturer-orders/add"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Add new order</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                ?>
                                <table>
                                    <thead>
                                    <tr class="row">
                                        <th class="col-1">Order ID</th>
                                        <th class="col-1">Date</th>
                                        <th class="col-2">Crop Name</th>
                                        <th class="col-1">Quantity</th>
                                        <th class="col-2">Unit Price</th>
                                        <th class="col-2">Producer</th>
                                        <th class="col-1">Order Status</th>
                                        <th class="col-2"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    function generateActions($orderId, $orderStatus): void
                                    {
                                        switch ($orderStatus) {
                                            case "Shipped":
                                                echo '<a class="btn-xs btn-outlined-primary-dark" 
                                                    href = "' . URL_ROOT . '/manufacturer-orders/changeStatus/' . $orderId . '">
                                                    Mark As Delivered
                                                    </a>';
                                                break;
                                            case "Pending":
                                                echo '<div class="px-1">
                                                        <a class="btn-xs btn-outlined-primary-dark" 
                                                        href = "' . URL_ROOT . '/manufacturer-orders/edit/' . $orderId . '">
                                                        Edit
                                                        </a>
                                                      </div>';
                                                echo '<div class="px-1">
                                                        <a class="btn-xs btn-outlined-error" 
                                                        href = "' . URL_ROOT . '/manufacturer-orders/delete/' . $orderId . '">
                                                        Delete
                                                        </a>
                                                      </div>';
                                                break;
                                            default:
                                                break;
                                        }
                                    }

                                    function renderStatus($orderStatus): void
                                    {
                                        echo match ($orderStatus) {
                                            "Pending" => '<span class="badge badge-warning">' . $orderStatus .
                                                '</span>',
                                            "Accepted" => '<span class="badge badge-primary">' . $orderStatus .
                                                '</span>',
                                            "Rejected" => '<span class="badge badge-danger">' . $orderStatus .
                                                '</span>',
                                            "Delivered" => '<span class="badge badge-success">' . $orderStatus .
                                                '</span>',
                                            "Shipped" => '<span class="badge badge-secondary">' . $orderStatus .
                                                '</span>',
                                            default => '<span>' . $orderStatus . '</span>',
                                        };
                                    }

                                    foreach ($this->data as $order) {
                                        ?>
                                        <tr class="row py-2">
                                            <td class="col-1"><?php echo $order->order_id; ?></td>
                                            <td class="col-1"><?php echo $order->date; ?></td>
                                            <td class="col-2"><?php echo $order->crop_name; ?></td>
                                            <td class="col-1"><?php echo $order->quantity; ?></td>
                                            <td class="col-2"><?php echo $order->unit_selling_price; ?></td>
                                            <td class="col-2 text-center"><?php echo $order->producer_name; ?></td>
                                            <td class="col-1"><?php renderStatus($order->status); ?></td>
                                            <td class="col-2 px-1 py-1">
                                                <div class="row justify-content-center align-items-center ">
                                                    <?php generateActions($order->order_id, $order->status) ?>
                                                </div>
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
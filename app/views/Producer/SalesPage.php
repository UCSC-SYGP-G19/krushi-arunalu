<?php

use app\views\inc\components\Table;

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
                                <h1 class="title">Sales</h1>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                $this->tableHeaders = [
                                    "order_id" => [
                                        "label" => "Order ID",
                                        "sortable" => true,
                                        "sortKey" => "order_id",
                                        "class" => "col-1",
                                    ],
                                    "order_date" => [
                                        "label" => "Date",
                                        "sortable" => true,
                                        "sortKey" => "date",
                                        "class" => "col-1",
                                    ],
                                    "crop_name" => [
                                        "label" => "Crop name",
                                        "sortable" => true,
                                        "sortKey" => "crop_name",
                                        "class" => "col-2",
                                    ],
                                    "quantity" => [
                                        "label" => "Qty",
                                        "sortable" => true,
                                        "sortKey" => "quantity",
                                        "class" => "col-1",
                                    ],
                                    "unit_selling_price" => [
                                        "label" => "Price per unit",
                                        "sortable" => true,
                                        "sortKey" => "unit_selling_price",
                                        "class" => "col-1"
                                    ],
                                    "manufacturer_name" => [
                                        "label" => "Manufacturer",
                                        "sortable" => true,
                                        "sortKey" => "Manufacturer",
                                        "class" => "col-2"
                                    ],
                                    "order_status" => [
                                        "label" => "Status",
                                        "sortable" => true,
                                        "sortKey" => "status",
                                        "class" => "col-2"
                                    ],
                                    "actions" => [
                                        "label" => "",
                                        "sortable" => false,
                                        "class" => "col-2"
                                    ]
                                ];
                                $salesTable = new Table(
                                    "sales",
                                    $this->tableHeaders,
                                    $this->data,
                                    "order_id",
                                    "No orders yet",
                                    ["Accept", "Decline"],
                                    ["accept", "decline"]
                                );
                                $salesTable->render();
                                ?>
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


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
                                <h1 class="title">Manufacturer Orders</h1>
                            </div>
                            <div class="col">
                                <a href="<?php echo URL_ROOT;?>/manufacturer-orders/add"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Add new order</a>
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
                                    "date" => [
                                        "label" => "Date",
                                        "sortable" => true,
                                        "sortKey" => "date",
                                        "class" => "col-1",
                                    ],
                                    "crop_name" => [
                                        "label" => "Crop Name",
                                        "sortable" => true,
                                        "sortKey" => "crop_name",
                                        "class" => "col-2",
                                    ],
                                    "quantity" => [
                                        "label" => "Quantity",
                                        "sortable" => false,
                                        "sortKey" => "quantity",
                                        "class" => "col-1",
                                    ],
                                    "unit_selling_price" => [
                                        "label" => "Unit Price",
                                        "sortable" => false,
                                        "sortKey" => "unit_selling_price",
                                        "class" => "col-1",
                                    ],
                                    "producer_name" => [
                                        "label" => "Producer",
                                        "sortable" => true,
                                        "sortKey" => "producer",
                                        "class" => "col-2",
                                    ],
                                    "status" => [
                                        "label" => "Status",
                                        "sortable" => true,
                                        "sortKey" => "status",
                                        "class" => "col-2",
                                    ],
                                    "actions" => [
                                        "label" => "",
                                        "sortable" => false,
                                        "class" => "col-2"
                                    ]
                                ];
                                $manufacturerOrderTable = new Table(
                                    $this->tableHeaders,
                                    $this->data,
                                    "order_id"
                                );
                                $manufacturerOrderTable->render();
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




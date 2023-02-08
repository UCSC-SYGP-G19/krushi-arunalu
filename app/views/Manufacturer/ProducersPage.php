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
                                <h1 class="title text-black">Producers</h1>
                            </div>
                            <div class="col">
                                <a href="producers/connectionRequests"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Connection Requests</a>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <span class="text-primary-light px-1 pt-3 fs-4 fw-bold">All</span>
                            <span class="text-secondary px-1 pt-3 fs-4 fw-bold mx-4">Connected</span>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                $this->tableHeaders = [
                                    "producer_id" => [
                                        "label" => "ID",
                                        "sortable" => true,
                                        "sortKey" => "id",
                                        "class" => "col-2",
                                    ],
                                    "producer_name" => [
                                        "label" => "Name",
                                        "sortable" => true,
                                        "sortKey" => "name",
                                        "class" => "col-4",
                                    ],
                                    "cultivating_crops" => [
                                        "label" => "Cultivating Crops",
                                        "sortable" => true,
                                        "sortKey" => "cultivating_crops",
                                        "class" => "col-4",
                                    ],
                                    "actions" => [
                                        "label" => "",
                                        "sortable" => false,
                                        "class" => "col-2"
                                    ]
                                ];
                                $producersTable = new Table($this->tableHeaders, $this->data, "producer_id");
                                $producersTable->render();
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

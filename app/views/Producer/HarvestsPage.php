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
                                <h1 class="title">My stocks</h1>
                            </div>
                            <div class="col">
                                <a href="harvests/add" class="btn-md btn-primary-light text-center text-white">
                                    Add harvest</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <section id="harvests-section"></section>
                                <?php
//                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
//                                $this->tableHeaders = [
//                                    "harvested_date" => [
//                                        "label" => "Harvested date",
//                                        "sortable" => true,
//                                        "sortKey" => "harvested_date",
//                                        "class" => "col-2",
//                                    ],
//                                    "crop_name" => [
//                                        "label" => "Crop name",
//                                        "sortable" => true,
//                                        "sortKey" => "crop_name",
//                                        "class" => "col-2",
//                                    ],
//                                    "harvested_quantity" => [
//                                        "label" => "Harvested quantity",
//                                        "sortable" => true,
//                                        "sortKey" => "harvested_quantity",
//                                        "class" => "col-2",
//                                    ],
//                                    "remaining_quantity" => [
//                                        "label" => "Remaining quantity",
//                                        "sortable" => true,
//                                        "sortKey" => "remaining_quantity",
//                                        "class" => "col-2",
//                                    ],
//                                    "expected_price" => [
//                                        "label" => "Expected price",
//                                        "sortable" => true,
//                                        "sortKey" => "price",
//                                        "class" => "col-2"
//                                    ],
//                                    "actions" => [
//                                        "label" => "",
//                                        "sortable" => false,
//                                        "class" => "col-2"
//                                    ]
//                                ];
//                                $harvestsTable = new Table("harvests", $this->tableHeaders, $this->data, "harvest_id");
//                                $harvestsTable->render();
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
    <script src="<?php echo URL_ROOT ?>/public/js/producer/harvests.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


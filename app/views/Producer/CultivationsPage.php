<?php

use app\views\inc\components\Table;

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
                                <h1 class="title">My cultivations</h1>
                            </div>
                            <div class="col">
                                <a href="cultivations/add" class="btn-md btn-primary-light text-center text-white">
                                    Add cultivation</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                $this->tableHeaders = [
                                    "land_name" => [
                                        "label" => "Land name",
                                        "sortable" => true,
                                        "sortKey" => "land_name",
                                        "class" => "col-2",
                                    ],
                                    "status" => [
                                        "label" => "Remarks",
                                        "sortable" => true,
                                        "sortKey" => "status",
                                        "class" => "col-1",
                                    ],
                                    "crop_name" => [
                                        "label" => "Crop name",
                                        "sortable" => true,
                                        "sortKey" => "crop_name",
                                        "class" => "col-2",
                                    ],
                                    "cultivated_quantity" => [
                                        "label" => "Cultivated quantity",
                                        "sortable" => true,
                                        "sortKey" => "cultivated_quantity",
                                        "class" => "col-1",
                                    ],
                                    "cultivated_date" => [
                                        "label" => "Cultivated date",
                                        "sortable" => true,
                                        "sortKey" => "cultivated_date",
                                        "class" => "col-2"
                                    ],
                                    "expected_harvest_date" => [
                                        "label" => "Expected harvest date",
                                        "sortable" => true,
                                        "sortKey" => "expected_harvest_date",
                                        "class" => "col-2"
                                    ],
                                    "actions" => [
                                        "label" => "",
                                        "sortable" => false,
                                        "class" => "col-2"
                                    ]
                                ];
                                $cultivationsTable = new Table("cultivations", $this->tableHeaders, $this->data, "cultivation_id");
                                $cultivationsTable->render();
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


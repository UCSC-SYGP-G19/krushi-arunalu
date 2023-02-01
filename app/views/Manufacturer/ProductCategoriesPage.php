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
                                <h1 class="title">Product Categories</h1>
                            </div>
                            <div class="col">
                                <a href="product-categories/add"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Add category</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                $this->tableHeaders = [
                                    "name" => [
                                        "label" => "Category Name",
                                        "sortable" => true,
                                        "sortKey" => "category_name",
                                        "class" => "col-4",
                                    ],
                                    "description" => [
                                        "label" => "Description",
                                        "sortable" => true,
                                        "sortKey" => "status",
                                        "class" => "col-6",
                                    ],
                                    "actions" => [
                                        "label" => "",
                                        "sortable" => false,
                                        "class" => "col-2"
                                    ]
                                ];
                                $productCategoriesTable = new Table($this->tableHeaders, $this->data, "id");
                                $productCategoriesTable->render();
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


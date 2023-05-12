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
                                <h1 class="title">Product Categories</h1>
                            </div>
                            <div class="col">
                                <a href="<?php echo URL_ROOT ?>/product-categories/requestToAdd"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Add new category</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <section id="product-categories"></section>
                            </div>
                        </div>
                        <div class="hidden-categories-wrapper px-1 py-3">
                            <button class="btn-hidden-categories text-primary-light fs-3 p-1 d-flex fw-bold"
                                    id="hidden-categories-toggle" value="show">Show hidden categories
                            </button>
                            <div class="mt-2 row gap-1 px-2" id="hidden-categories">
                                //                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                //                                $this->tableHeaders = [
                                //                                    "name" => [
                                //                                        "label" => "Category Name",
                                //                                        "sortable" => true,
                                //                                        "sortKey" => "category_name",
                                //                                        "class" => "col-4",
                                //                                    ],
                                //                                    "description" => [
                                //                                        "label" => "Description",
                                //                                        "sortable" => true,
                                //                                        "sortKey" => "status",
                                //                                        "class" => "col-6",
                                //                                    ],
                                //                                    "actions" => [
                                //                                        "label" => "",
                                //                                        "sortable" => false,
                                //                                        "class" => "col-2"
                                //                                    ]
                                //                                ];
                                //                                $productCategoriesTable = new Table(
                                //                                    "product-categories",
                                //                                    $this->tableHeaders,
                                //                                    $this->data,
                                //                                    "id",
                                //                                    "",
                                //                                    ["Edit", "Hide"],
                                //                                    ["edit", "hide"],
                                //                                );
                                //                                $productCategoriesTable->render();
                                //                                ?>
                            </div>
                        </div>
                        <!--                        <div class="hidden-categories-wrapper px-1 py-3">-->
                        <!--                            <button class="btn-hidden-categories text-primary-light fs-3 p-1 d-flex fw-bold"-->
                        <!--                                    id="hidden-categories-toggle" value="show">Show hidden categories-->
                        <!--                            </button>-->
                        <!--                            <div class="mt-2 row gap-1 px-2" id="hidden-categories">-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
            <?php
            include APP_ROOT . "/views/inc/components/Footer.php";
            ?>
        </main>
    </div>
    <script src="<?php echo URL_ROOT ?>/public/js/tables.js"></script>
    <script src="<?php echo URL_ROOT ?>/public/js/Manufacturer/productCategories.js" defer></script>
    <script src="<?php echo URL_ROOT ?>/public/js/hiddenCategories.js"></script
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


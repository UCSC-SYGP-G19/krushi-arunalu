<?php

include APP_ROOT . "/views/inc/components/Header.php";
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/1.30.1/date_fns.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
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
                    <div class="container-fluid px-2 manufacturer-dashboard">
                        <div class="row px-1 pt-1 pb-1">
                            <div class="col-12">
                                <h1 class="title">Welcome <?php echo \app\helpers\Session::getSession()->name ?></h1>
                            </div>
                        </div>
                        <div class="row px-1 py-3 gap-3">
                            <div class="col-12 col-6-md">
                                <div class="dashboard-card px-4 py-4 m-auto min-h-100">
                                    <h3 class="pb-2 text-center">Most Selling Products</h3>
                                    <hr class="primary-color my-1">
                                    <div class="pt-3 pb-0 px-3" id="most-selling-products-container">
                                        <div class="row pb-2 fw-bold text-center">
                                            <div class="col-6">Product Name</div>
                                            <div class="col-6">Total Sales</div>
                                        </div>
                                        <?php foreach ($this->data['most_selling_products'] as $item) { ?>
                                            <div class="row py-1 px-3 ">
                                                <div class="col-6">
                                                    <?php echo $item->product_name ?>
                                                </div>
                                                <div class="col-6 text-right fw-bold text-primary-light pr-5">
                                                    <?php echo $item->total_sales ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-6-md">
                                <div class="dashboard-card px-4 py-4 m-auto min-h-100">
                                    <h3 class="pb-2 text-center">Most Purchased Materials</h3>
                                    <hr class="primary-color my-1">
                                    <div class="pt-3 pb-0 px-3" id="most_purchased_materials-container">
                                        <div class="row pb-2 fw-bold text-center">
                                            <div class="col-6">Crop Name</div>
                                            <div class="col-6">Total Purchases</div>
                                        </div>
                                        <?php foreach ($this->data["most_purchased_materials"] as $item) { ?>
                                            <div class="row py-1 px-3">
                                                <div class="col-6">
                                                    <?php echo $item->crop_name ?>
                                                </div>
                                                <div class="col-6 text-right fw-bold text-primary-light pr-5">
                                                    <?php echo $item->total_purchases ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-12-md">
                                <div class="dashboard-card p-4 m-auto min-h-100">
                                    <h2 class="col-12 text-center mb-1">Product Analytics</h2>
                                    <hr class="primary-color my-1">
                                    <div class="row">
                                        <h3 class="col-12 text-center fw-bold mb-2 text-primary-light py-2">
                                            Monthly Sales</h3>
                                    </div>
                                    <div class="pt-2 pb-0 px-3" id="monthly_sales_container">
                                        <div class="canvas-wrapper py-1 px-2" id="canvas-wrapper"></div>
                                    </div>
                                </div>
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
    <script src="<?php echo URL_ROOT ?>/public/js/Manufacturer/dashboard.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";

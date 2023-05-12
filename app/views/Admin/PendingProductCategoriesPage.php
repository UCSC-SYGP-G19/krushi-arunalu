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
                                <h1 class="title">Pending Approvals</h1>
                            </div>
                            <div class="">
                                <?php echo '<a class="btn-md btn-primary-light text-center text-white" href = "
                                 ' . URL_ROOT . '/product-categories">Back to Product Categories</a>' ?>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                ?>
                                <div class="" id="pending-approval-list">
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
    <script src="<?php echo URL_ROOT ?>/public/js/Admin/pendingCategoryRequests.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


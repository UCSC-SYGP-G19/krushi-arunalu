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
                    <div class="container-fluid px-">
                        <div class="row px-1 pt-1 justify-content-space-between">
                            <div class="col-6">
                                <h1 class="title">Inquiries</h1>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                ?>
                            </div>
                        </div>
                        <div class="px-1">
                            <?php foreach ($this->data as $inquiry) { ?>
                                <div class="row inquiry-wrapper col-12 px-4 py-3 d-block mb-3">
                                    <div class="d-block col-12">
                                        <div class="text-black fw-bold fs-4">
                                            <?php echo $inquiry->content ?></div>
                                        <div class="product-name fw-bold fs-3 text-secondary">
                                            <?php echo $inquiry->product_name ?>
                                        </div>
                                    </div>
                                    <div class="row py-1 justify-content-end">
                                        <div class="responded text-white py-1 px-2 mr-2" HIDDEN>Responded ✓️</div>
                                        <div class="text-primary-light fw-bold p-1">
                                            <?php echo $inquiry->customer_name ?>
                                            <span class="text-secondary pl-2">
                                       asked on <?php echo $inquiry->asked_date?>
                                    </span>
                                        </div>
                                    </div>

                                    <div class="row pt-1">
                                        <div class="col-1 text-center">
                                            <?php echo '<img src="' . URL_ROOT . '/public/img/manufacturer/' .
                                                $inquiry->company_logo . ' " 
                class="user-profile-pic" alt="User profile icon" height="56px">' ?>
                                        </div>
                                        <div class="col-11 py-2">
                                            <textarea class="col-12" placeholder="Write a Response"></textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
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


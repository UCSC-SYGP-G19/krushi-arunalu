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
                                <h1 class="title text-black">Connection Requests</h1>
                            </div>
                            <div class="">
                                <?php echo '<a class="btn-md btn-primary-light text-center text-white" href = "
                                 ' . URL_ROOT . '/producers">Back to Producers</a>' ?>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <span class="text-primary-light px-1 pt-3 fs-4 fw-bold">Received</span>
                            <span class="text-secondary px-1 pt-3 fs-4 fw-bold mx-4">Sent</span>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                ?>
                                <div class="request-card-wrapper col-12 p-3 d-flex justify-content-space-between mb-3">
                                    <div class="d-flex">
                                        <div class="user-profile-pic">
                                            <?php echo '<img src="
                                            ' . URL_ROOT . '/public/img/icons/navbar/user-avatar.webp"
                                            alt="User profile icon" height="56px">' ?>
                                        </div>
                                        <div class="d-block">
                                            <div class="user-name px-4 pt-1 fw-bold">
                                                Producer 1
                                            </div>
                                            <div class="user-location px-4">
                                                Location
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-container">
                                        <button class="btn-primary-light text-white mx-2">Accept</button>
                                        <button class="btn-outlined-error text-error mx-2">Decline</button>
                                    </div>
                                </div>


                                <!--                                <div class="request-card-wrapper col-12 p-3 d-flex
                                                                                justify-content-space-between mb-3">-->
                                <!--                                    <div class="d-flex">-->
                                <!--                                        <div class="user-profile-pic">-->
                                <!--                                            --><?php //echo '<img src="
                                //                                            ' . URL_ROOT . '/public/img/icons/navbar/user-avatar.webp"
                                //                                            alt="User profile icon" height="56px">' ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="d-block">-->
                                <!--                                            <div class="user-name px-4 pt-1
                                                                                fw-bold">-->
                                <!--                                                Producer 2-->
                                <!--                                            </div>-->
                                <!--                                            <div class="user-location px-4">-->
                                <!--                                                Location-->
                                <!--                                            </div>-->
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="btn-container">-->
                                <!--                                        <button class="btn-outlined-error
                                                                       text-error mx-2">Delete Request</button>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
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


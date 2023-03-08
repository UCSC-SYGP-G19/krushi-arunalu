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
                            <span class="text-primary-light px-1 pt-3 fs-4 fw-bold active-page">Received</span>
                            <span class="text-secondary px-1 pt-3 fs-4 fw-bold mx-4">Sent</span>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                ?>
                                <div class="connection-request-wrapper">

                                    <?php if (sizeof($this->data) > 0) {
                                        foreach ($this->data as $producer) { ?>
                                        <div class="request-card-wrapper col-12 p-3 d-flex justify-content-space-between
                                                mb-3">
                                            <div class="d-flex">
                                                <div class="profile-pic">
                                                    <?php echo '<img class="user-profile-pic" src="
                                            ' . URL_ROOT . '/public/img/producer/' . $producer->profile_pic . '"
                                            alt="User profile icon" height="56px">' ?>
                                                </div>
                                                <div class="d-block">
                                                    <div class="user-name px-4 pt-1 fw-bold">
                                                        <?php echo $producer->sender_name ?>
                                                    </div>
                                                    <div class="user-location px-4">
                                                        <?php echo $producer->location ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-container d-flex">
                                                <div class="mx-2"><?php echo'<a class="btn-md btn-primary-light
                                                text-center text-white" href="' . URL_ROOT . '/producers/accept/'
                                                        . $producer->request_id . '">Accept</a>'?>
                                                </div>
                                                <div class="mx-2"><?php echo'<a class="btn-md btn-outlined-error 
                                                text-center text-error" href="' . URL_ROOT . '/producers/decline/'
                                                 . $producer->request_id . '">Decline</a>'?>
                                                </div>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                    } else { ?>
                                        <div class="request-card-wrapper text-center py-3">
                                            <?php
                                            echo "No Pending Requests";
                                            ?>
                                        </div>
                                    <?php }?>
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
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


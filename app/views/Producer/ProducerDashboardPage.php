<?php

use app\helpers\Session;

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
                        <div class="row px-1 pt-1">
                            <div class="col-12">
                                <h1 class="title">Producer Dashboard</h1>
                            </div>
                        </div>
                        <div class="row px-1">
                            <div class="col-12 text-center justify-content-center align-items-center">
                                <img src="<?php echo URL_ROOT ?>/public/img/other/webpage-under-construction.gif"
                                     class="p-4" alt="Webpage under construction" width="35%">
                                <br>
                                <h2 class="fw-normal pt-3 pb-1">Webpage under construction</h2>
                                <h3 class="fw-light pb-3 text-grey-dark">Please check back later 😉</h3>

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
    <script>
      toast("check","Hi <?php echo explode(" ", Session::getSession()->name)[0]?>!" ,"Welcome to Krushi Arunalu");
    </script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";

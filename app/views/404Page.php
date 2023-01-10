<?php
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

    <body class="overflow-hidden full-height error-404-page">
    <?php
    //include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
    ?>
    <div class="">
        <main class="content overflow-y-auto">

            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1">
                            <div class="col-12 text-center justify-content-center align-items-center">
                                <img class="p-2 pb-0 pt-3" src="<?php echo URL_ROOT ?>/public/img/other/error-404.gif"
                                     alt="Error 404"
                                     height="85%">
                                <h2 class="fw-light pb-3 text-grey-dark">Page not found</h2>

                                <a href="http://localhost/krushi-arunalu" class="btn-primary-light btn-lg text-white">
                                    ← &ensp;Go back home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


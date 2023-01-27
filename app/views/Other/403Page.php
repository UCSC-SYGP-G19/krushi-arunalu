<?php
include APP_ROOT . "/views/inc/components/Header.php";

?>
    <body class="overflow-hidden full-height error-403-page">
    <div class="">
        <main class="content">
            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1">
                            <div class="col-12 text-center justify-content-center align-items-center">
                                <img class="p-0 pb-0 pt-3" src="<?php echo URL_ROOT ?>/public/img/other/error-403.webp"
                                     alt="Error 40"
                                     height="100%">
                                <h2 class="fw-light pt-3 pb-3 text-grey-dark">
                                    You are not authorized to access this page</h2>

                                <a href="http://localhost/krushi-arunalu"
                                   class="my-2 btn-primary-light btn-lg text-white">
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


<?php
include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-hidden">
<?php
include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
?>
<main class="index container-fluid d-flex align-items-center justify-content-center">
    <div class="row mt-5 mb-2">
        <div class="col-12 mt-5 mb-2">
            <img src="<?php echo URL_ROOT ?>/public/img/logo-large.webp"
                 alt="Krushi Arunalu Logo" height="240px" class="pt-1">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col p-4 px-4">
            <a class="card row px-3 mx-2" href="marketplace">
                <div class="col-5">
                    <img src="<?php echo URL_ROOT ?>/public/img/index-page/customer-graphic.webp"
                         alt="Customer graphic" height="auto" class="p-">
                </div>
                <div class="col-7 px-2">
                    <h2 class="fw-light">For<br><span class="fw-bold">Customers</span></h2>
                </div>
            </a>
        </div>
        <div class="col p-4 px-4">
            <a class="card row px-3 mx-2" href="login">
                <div class="col-5">
                    <img src="<?php echo URL_ROOT ?>/public/img/index-page/farmer-graphic.webp"
                         alt="Farmer graphic" height="auto" class="p-2">
                </div>
                <div class="col-7 px-2">
                    <h2 class="fw-light">For<br>
                        <span class="fw-bold fs-4">producers, manufacturers & agri-officers</span></h2>
                </div>
            </a>
        </div>
    </div>
    <div class="row scroll-down pt-3 pb-2">
        <a class="ca3-scroll-down-link ca3-scroll-down-arrow" href="#about-us"></a>
    </div>
    <!--    <div class="wrapper px-4 py-3 mt-5">-->
    <!---->
    <!--    </div>-->
</main>
</body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
?>

<?php

use app\views\inc\components\Table;

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
                                <h1 class="title">Crop Requests</h1>
                            </div>
                            <div class="col">
                                <?php echo '<a href="' . URL_ROOT . '/manufacturer-crop-requests/add" 
                  class="btn-md btn-primary-light text-center text-white">Post crop request</a>' ?>
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
                        <div class="crop-request-card-wrapper p-3 mb-3 d-flex">
                            <div class="col-1">
                                <?php
                                echo '<div class="image-window">
                                    ' .
                                    '<img alt="Product image" height="100%" width="100%" src="'
                                    . URL_ROOT . '/public/img/products/cloves.jpg">' . '
                                    </div>'
                                ?>
                            </div>
                            <div class="col-9 py-1">
                                <div class="col-12 d-flex px-4">
                                    <span class="text-black fw-bold fs-4 pr-1">Cloves</span>
                                    <span class="text-black fs-4">- 50 KG</span>
                                </div>
                                <div class="col-12 d-flex px-4 fs-3 text-grey-dark pt-1">
                                    <span class="pr-1">Requested</span>
                                    <span class="fw-bold">- 50 KG</span>
                                    <span class="px-1">| Required</span>
                                    <span class="fw-bold">- 30 KG</span>
                                </div>
                                <div class="col-12 d-flex px-4 pt-2 fs-3">
                                    <span class="text-primary-light fw-bold pr-1">3 Responses -</span>
                                    <span class="fulfilled-quantity text-black fw-bold px-2">
                                        20 KG fulfilled / 50 KG requested</span>
                                </div>
                            </div>
                            <div class="col-2 py-4 justify-content-space-between d-flex px-2">
                                <button class="btn-secondary fs-3">
                                    <?php echo '<a href="' . URL_ROOT . '/manufacturer-crop-requests/edit" >Edit</a>' ?>
                                </button>
                                <button class="btn-outlined-error fs-3">
                                    <?php echo '<a href="' . URL_ROOT . '/manufacturer-crop-requests/delete" >
                                Delete</a>' ?></button>
                            </div>
                        </div>
                        <div class="crop-request-card-wrapper px-3 pt-3 pb-4 mb-3">
                            <div class="col-12 d-flex">
                                <div class="col-1">
                                    <?php
                                    echo '<div class="image-window">
                                    ' .
                                        '<img alt="Product image" height="100%" width="100%" src="'
                                        . URL_ROOT . '/public/img/products/cinnamon.jpg">' . '
                                    </div>'
                                    ?>
                                </div>
                                <div class="col-9 py-1">
                                    <div class="col-12 d-flex px-4">
                                        <span class="text-black fw-bold fs-4 pr-1">Cinnamon</span>
                                        <span class="text-black fs-4">- 50 KG</span>
                                    </div>
                                    <div class="col-12 d-flex px-4 fs-3 text-grey-dark py-1">
                                        <span class="pr-1">Requested</span>
                                        <span class="fw-bold">- 50 KG</span>
                                        <span class="px-1">| Required</span>
                                        <span class="fw-bold">- 30 KG</span>
                                    </div>
                                    <div class="col-12 d-flex px-4 fs-3 text-grey-dark">
                                        <span class="pr-1">Expected price range</span>
                                        <span class="fw-bold">- Rs. 400 to Rs. 500 per unit</span>
                                    </div>
                                </div>
                                <div class="col-2 py-4 justify-content-space-between d-flex px-2">
                                    <button class="btn-secondary fs-3">
                                        <?php echo '<a href="' . URL_ROOT . '/manufacturer-crop-requests/edit" >
                                        Edit</a>' ?>
                                    </button>
                                    <button class="btn-outlined-error fs-3">
                                        <?php echo '<a href="' . URL_ROOT . '/manufacturer-crop-requests/delete" >
                                Delete</a>' ?></button>
                                </div>
                            </div>
                            <div class="col-12 d-flex pt-1 fs-3 mb-3">
                                <span class="text-primary-light fw-bold pr-1">2 Responses -</span>
                                <span class="fulfilled-quantity text-black fw-bold px-2">
                                        20 KG fulfilled / 50 KG requested</span>
                            </div>
                            <hr/>

                            <div class="crop-response-card-wrapper d-flex mt-3">
                                <div class="col-1 user-profile-pic text-center">
                                    <?php echo '<img src="' . URL_ROOT . '/public/img/icons/navbar/user-avatar.webp" 
                alt="User profile icon" height="56px">' ?>
                                </div>
                                <div class="col-11 crop-response-card-content py-2 pl-3 pr-4">
                                    <div class="col-12 d-flex">
                                        <div class="col-6 text-black fw-bold fs-4">Producer 01</div>
                                        <div class="col-6 text-primary-light fw-bold fs-3 text-right">
                                            07th August 2022</div>
                                    </div>
                                    <div class="col-12 d-flex fs-2 text-grey-dark pb-1">
                                        <span class="pr-1">District</span>
                                    </div>
                                    <div class="col-12 d-flex fs-3 text-grey-dark mb-1">
                                        <span class="">Accepted quantity -</span>
                                        <span class="accepted-quantity fw-bold ml-1 px-1">10 KG</span>
                                    </div>
                                    <div class="row d-flex">
                                        <div class="col-6 d-flex fs-3 text-grey-dark">
                                            <span class="pr-1">Accepted price</span>
                                            <span class="fw-bold">- Rs. 400 per unit</span>
                                        </div>
                                        <div class="col-6 d-flex fs-3 text-grey-dark">
                                            <span class="pr-1">Accepted delivery date</span>
                                            <span class="fw-bold">- 28th Oct 2022</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="crop-response-card d-flex mt-3">
                                <div class="col-1 user-profile-pic text-center">
                                    <?php echo '<img src="' . URL_ROOT . '/public/img/icons/navbar/user-avatar.webp" 
                alt="User profile icon" height="56px">' ?>
                                </div>
                                <div class="col-11 crop-response-card-content py-2 pl-3 pr-4">
                                    <div class="col-12 d-flex">
                                        <div class="col-6 text-black fw-bold fs-4">Producer 02</div>
                                        <div class="col-6 text-primary-light fw-bold fs-3 text-right">
                                            29th August 2022</div>
                                    </div>
                                    <div class="col-12 d-flex fs-2 text-grey-dark pb-1">
                                        <span class="pr-1">District</span>
                                    </div>
                                    <div class="col-12 d-flex fs-3 text-grey-dark mb-1">
                                        <span class="">Accepted quantity -</span>
                                        <span class="accepted-quantity fw-bold ml-1 px-1">10 KG</span>
                                    </div>
                                    <div class="row d-flex">
                                        <div class="col-6 d-flex fs-3 text-grey-dark">
                                            <span class="pr-1">Accepted price</span>
                                            <span class="fw-bold">- Rs. 420 per unit</span>
                                        </div>
                                        <div class="col-6 d-flex fs-3 text-grey-dark">
                                            <span class="pr-1">Accepted delivery date</span>
                                            <span class="fw-bold">- 17th Oct 2022</span>
                                        </div>
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
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


<?php
include APP_ROOT . "/views/inc/components/Header.php";

?>

    <body class="overflow-hidden full-height">
    <div class="content-with-sidebar">
        <?php
        if (isset($this->user)) {
            include APP_ROOT . "/views/inc/components/Sidebar.php";
        }
        ?>
        <main class="content overflow-y-auto">
            <?php
            if (isset($this->user)) {
                include APP_ROOT . "/views/inc/components/CustomerLoggedInNavbar.php";
            } else {
                include APP_ROOT . "/views/inc/components/LoggedOutNavbarWithLoginLink.php";
            }
            ?>

            <div class="content-wrapper product-details">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 pt-1">
                            <div class="col-12">
                                <h1 class="title">Product Details</h1>
                            </div>
                        </div>
                        <br>
                        <div class="row px-1 gap-2">
                            <div class="col-3">
                                <?php
                                echo '<div class="image-window mb-1">
                                    ' .
                                    '<img alt="Product image" height="100%" width="100%" src="'
                                    . URL_ROOT . '/public/img/products/' . $this->data->image_url .
                                    '">' . '
                                    </div>'
                                ?>
                            </div>
                            <div class="col-6 mt-2" >
                                <?php
                                echo '<div class="product-data">
                                    ' . '<h1 class="product-name">' .
                                    $this->data->name
                                    . '</h1>' .
                                    '<br><p class="product-description">' .
                                    $this->data->description .
                                    '</p><br>' .
                                    '<h6>' .
                                        'Rs. ' .
                                        $this->data->unit_selling_price .
                                    '</h6>' .

                                    '</div>'
                                ?>
                                <div class="mt-1 mb-3 ">
                                    <a class="btn-lg btn-primary-light mt-3 text-center text-white"
                                       href=<?php echo URL_ROOT . "/marketplace/send-inquiry/" . $this->data->id?>>
                                        Inquire Now
                                    </a>
                                    <a class="btn-lg btn-primary-light mt-3 text-center text-white"
                                       href=<?php echo URL_ROOT . "/shopping-cart/add/" . $this->data->id?>>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row px-1 gap-2">

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


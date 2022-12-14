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

    <body class="overflow-hidden full-height">
    <?php
    //include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
    ?>
    <div class="content-with-sidebar">
        <?php
        include APP_ROOT . "/views/inc/components/Sidebar.php"
        ?>
        <main class="content overflow-y-auto">
            <?php
            include APP_ROOT . "/views/inc/components/LoggedInNavbar.php"
            ?>

            <div class="content-wrapper marketplace">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 pt-1">
                            <div class="col-12">
                                <h1 class="title">Marketplace</h1>
                            </div>
                        </div>
                        <br>
                        <div class="row px-1">
                            <?php foreach ($this->data as $product) {
                                echo '<div class="col-3 product-card text-center p-3 pb-2">
                                <div class="">
                                    <div class="image-window mb-1">
                                    ' .
                                    '<img src="' . URL_ROOT . '/public/img/product-image.jpg" 
                alt="Product image" height="100%" width="100%">' .
                                    '
                                    </div>
                                    <div class="text-center">
                                        <h3 class="pt-2 pb-0 product-name">' . $product->getName() . '</h3>
                                        <h4 class="product-price text-light-green py-1 pb-2">' . $product->getUnitSellingPrice() . '</h4>
                                        <div class="row gap-1">
                                            <div class="col-5">
                                                <label>
                                                    <input type="number" value="1">
                                                </label>
                                            </div>
                                            <div class="col-7">
                                                <button class="btn-primary-light text-white">Buy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            }
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


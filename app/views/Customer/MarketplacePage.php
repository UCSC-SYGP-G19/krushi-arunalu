<?php
include APP_ROOT . "/views/inc/components/Header.php";

?>
    <!--    <div class="navbar-section container-fluid">-->

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
        <!--        --><?php
        //        if (isset($this->user)) {
        //            include APP_ROOT . "/views/inc/components/Sidebar.php";
        //        }
        //        ?>
        <main class="content overflow-y-auto">
            <?php
            if (isset($this->user)) {
                include APP_ROOT . "/views/inc/components/LoggedInNavbar.php";
            } else {
                include APP_ROOT . "/views/inc/components/LoggedOutNavbarWithLoginLink.php";
            }
            ?>
            <div class="content-wrapper marketplace">
                <div class="container-fluid px-0">
                    <div class="carousel">
                        <img src="<?php echo URL_ROOT . '/public/img/manufacturers/covers/banner_02.jpg' ?>" alt=""
                             class="pic" height="100%">
                        <img src="<?php echo URL_ROOT . '/public/img/manufacturers/covers/banner_03.jpg' ?>" alt=""
                             class="pic" height="100%">
                        <img src="<?php echo URL_ROOT . '/public/img/manufacturers/covers/banner_04.jpg' ?>" alt=""
                             class="pic" height="100%">
                        <img src="<?php echo URL_ROOT . '/public/img/manufacturers/covers/banner_05.jpg' ?>" alt=""
                             class="pic" height="100%">
                        <img src="<?php echo URL_ROOT . '/public/img/manufacturers/covers/banner_06.jpg' ?>" alt=""
                             class="pic" height="100%">
                    </div>
                </div>
                <div class="content p-4 mt-1">
                    <div class="container px-2">
                        <div class="row px-1 pt-1">
                            <div class="col-12">
                                <h1 class="title">Marketplace</h1>
                            </div>
                        </div>
                        <br>
                        <div class="row px-1">
                            <?php foreach ($this->data as $product) {
                                echo '<div class="col-3 text-center p-2">
                                <div class="product-card  p-3 pb-2">
                                    <div class="image-window mb-1">
                                    ' .
                                    '<a href="marketplace/product-details/' . $product->id .
                                    '">' .
                                    '<img alt="Product image" height="100%" width="100%" src="' . URL_ROOT .
                                    '/public/img/products/' .
                                    $product->image_url . '">'
                                    . '</a>' .
                                    '
                                    </div>
                                    <div class="text-center">
                                        
                                        <h3 class="pt-2 pb-0 product-name">' . $product->name . '</h3>
                                        <h4 class="product-price text-light-green py-1 pb-2">'
                                    . $product->unit_selling_price . '</h4>
                                        <div class="row gap-1">
                                            <div class="col-5">
                                            
                                                <label>
                                                    <input type="number" name="quantity" value="1" min="1">
                                                </label>
                                            </div>
                                            <div class="col-7">
                                                <button onClick="addItemToCart(' . $product->id . ')" class="btn-add-to-cart btn-primary-light text-white p-0" value="' . $product->id . '"><svg class="py-1" width="45" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
    <script src="<?php echo URL_ROOT ?>/public/js/addToCart.js" defer>
    </script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


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
        <main class="content overflow-y-auto">
            <?php
            if (isset($this->user)) {
                include APP_ROOT . "/views/inc/components/CustomerLoggedInNavbar.php";
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
                                <div class="product-card p-3 pb-1" id="product-card-' . $product->id . '">
                                        <a href="marketplace/productDetails/' . $product->id . '">
                                            <div class="image-window mb-1">
                                                       <div class="rating-box px-1 d-flex">
                                                    <span class="rating-icon">    
                                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.90931 12.115L2.863 14.6382L4.12456 9.59191L0.339844 5.38663L5.80667 4.9661L7.90931 0.340332L10.0119 4.9661L15.4788 5.38663L11.694 9.59191L12.9556 14.6382L7.90931 12.115Z" fill="#E7A811"/>
                                                        </svg>
                                                    </span>
                                                    <span class="rating-text fw-bold">' . $product->rating . '</span>
                                                </div>
                                                        ' .
                                    '<img alt="Product image" height="100%" width="100%" src="' . URL_ROOT .
                                    '/public/img/products/' .
                                    $product->image_url . '">'
                                    . '
                                            </div>
                                        </a>
                                    <div class="text-center">
                                        <h3 class="pt-2 pb-0 product-name">' . $product->name . '</h3>
                                        <h4 class="product-price text-light-green py-1 pb-2">'
                                    . $product->unit_selling_price . '</h4>
                                        <div class="row gap-1">
                                            <div class="col-6">
                                                <label>
                                                    <input type="number" name="quantity" value="1" min="1">
                                                </label>
                                            </div>
                                            <div class="col-6">
                                                <button onClick="addItemToCart(' . $product->id . ')" type="button"
                                                name="add-to-cart"
                                                class="btn-add-to-cart btn-primary-light text-white p-0"
                                                value="' . $product->id . '">
                                                <svg class="pt-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <rect width="24" height="24" fill="url(#pattern0)"/>
                                                    <defs>
                                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                    <use xlink:href="#image0_1798_9020" transform="scale(0.0208333)"/>
                                                    </pattern>
                                                    <image id="image0_1798_9020" width="48" height="48" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAACrElEQVRoge2Yv2sUQRTH31xCMAFttDbpPVDLFIr4F0QstbTRShAi1hI5BTmtFCVa2AtaGwvFOhFtrPQEtUqKaC65/PBjcXN3z83uzczurImwn2oyN+/7vm9+7OxGpKKiomJfANwC1hnwE3gHnN9rb04AYw1nMRchx11gA7gTw3NagrnECiSZLqjfsTqdWJ5dCQ8Bz1UBjwrq9Ynl0Sfp9JAVceJTQA7ZDeBmL944CpgQkVURGckzAcaYvr42ntUfwC9jzEERkZrDQFtEPuVIUDatXmNoAZYl1b5sAvBxEqB1Jc2TTwGLqn3Sx1RJ6Nx9T6ErcCKanXB07qXMUUmAw+oJsA6M5sme9RTyjB0F2kriSKjAVxV8LNSA1ShSQF2Ft/RvPltIZO/PQer+F/EvIOgcALeBLaAJpOYAavb3baDhkDyu2u89/O5KNqOWcMFjvN6v89aspmb7e6w59BbU2Jk8BUwqgWWP8c2E4XnH302H3rIaOxlcQKgI3dfzB/jxhIxtZrWm1NgVwOuCTBN6rYScy+hZxFDzVuecGr9r+/oeYpG/T7/zIBtjkO71/zBjyFMRuWSM+e2Q0rkWM0e5AC6qmXgREJe2Es6ZV/EvVdyFIgVkXiYesTXgPrAK3PM1b2NbKm893PlAaARYU2Jh13m+nPo1pk3Ka4z3TBhjdkTko+o6E8Okg7Oq/cEYs50cEHKIRUT0U2AWOJDLlgdWe1Z1vYohOsXgvwsAb4BTwHhh8UGOceA08Fbl6QBHYyW4xr/nahTzqogbdF/WymYLuB7VvCqiDjwGvgCbEU1vAp+tdq5vj4r/DmCM7kfMd+Ab0ADGyoqLjk2cxPWVlTsuOnYGk/woK04TehNneknp2ykxrk+sAp559sWKi4s9jA17EEMPcXBcRUVFxf7hD9Ljr4SMCfzIAAAAAElFTkSuQmCC"/>
                                                    </defs>
                                                </svg>
                                            </button>
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


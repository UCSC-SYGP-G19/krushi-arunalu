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

            <div class="content-wrapper marketplace">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 pt-1">
                            <div class="col-12">
                                <h1 class="title">Manufacturers</h1>
                            </div>
                        </div>
                        <br>
                        <div class="row px-1">
                            <?php foreach ($this->data as $element) {
                                echo '<div class="col-3 text-center p-2">
                                <div class="product-card  p-3 pb-2">
                                    <div class="image-window mb-1">
                                    ' .
                                    '<a href=" ' . URL_ROOT . '/marketplace/manufacturerStore/' . $element->manufacturer_id . '">' .
                                    '<img alt="Manufacturer logo" height="100%" width="100%" src="' . URL_ROOT .
                                    '/public/img/user-avatars/' .
                                    $element->manufacturer_image_url . '">'
                                    . '</a>' .
                                    '
                                    </div>
                                    <div class="text-center">
                                        <h4 class="pt-2 pb-0 manufacturer-name">' . $element->
                                    manufacturer_name . '</h4>
                                        <h4 class="manufacturer-description text-light-green py-1 pb-2">'
                                    . $element->manufacturer_description . '</h4>
                                        <div class="row gap-1 justify-content-center pt-2 pb-2">
                                                <a class="fw-bold btn-outlined-primary-light" href=" ' . URL_ROOT . '/marketplace/manufacturerStore/' .
                                    $element->manufacturer_id . '">Visit store</a>
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


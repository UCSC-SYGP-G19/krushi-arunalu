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
                include APP_ROOT . "/views/inc/components/LoggedInNavbar.php";
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
                                echo '<div class="col-3 text-center p-3">
                                <div class="product-card  p-3 pb-2">
                                    <div class="image-window mb-1">
                                    ' .
                                    '<a href="marketplace/product-details/' . $element->manufacturer_id .
                                    '">' .
                                    '<img alt="Manufacturer image" height="100%" width="100%" src="' . URL_ROOT .
                                    '/public/uploads/user-avatars/' .
                                    $element->manufacturer_image_url . '">'
                                    . '</a>' .
                                    '
                                    </div>
                                    <div class="text-center">
                                            <div class="fw-bold pt-2 pb-1 manufacturer-name">' . $element->
                                    manufacturer_name . '
                                            </div>
                                            <div class="row gap-1">
                                                ' .
                                    '<a class="col-7 btn-lg btn-outlined-primary-light text-center" 
                                                href="./manufacturers/manufacturerStore/' . $element->manufacturer_id .
                                    '">' .
                                    'Visit Store' . '</a>' . '
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


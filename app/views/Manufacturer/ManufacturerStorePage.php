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
    <div class="content-with-sidebar">
        <main class="content overflow-y-auto">
            <?php
            if (isset($this->user)) {
                include APP_ROOT . "/views/inc/components/LoggedInNavbarWithoutSidebar.php";
            } else {
                include APP_ROOT . "/views/inc/components/LoggedOutNavbarWithLoginLink.php";
            }
            ?>

            <div class=" d-flex align-items-center justify-content-center">
                <div class="manufacturer-store-wrapper">
                    <div class="pl-0  py-3">
                        <button class="btn-outlined-secondary fs-3 fw-bold" onclick="history.back()">Back</button>
                    </div>
                    <div class="company-info-wrapper">
                        <div class="store-cover col-12">
                            <?php
                            echo '<img class="col-12" alt="Cover Image" height="100%" width="100%" src="' . URL_ROOT .
                                '/public/img/company-covers/' . $this->data["manufacturer"]->cover_image . '"' . '>'
                            ?>
                        </div>
                        <div class="row store-info-wrapper">
                            <div class="store-info d-flex p-3">
                                <div class="col-10">
                                    <div class="row col-12 d-flex">
                                        <div class="company-logo col-3">
                                            <?php echo
                                                '<img class="company-logo" alt="Company Logo" src="
                                        ' . URL_ROOT . '/public/img/user-avatars/company_logo.png"' . '>'
                                            ?>
                                        </div>
                                        <div class="company-details col-9 p-3">
                                            <div class="col-12 company-name text-left fw-bold py-3">
                                                <?php echo $this->data["manufacturer"]->company_name ?>
                                            </div>
                                            <div class="col-12 d-flex pb-3">
                                                <div class="col-6 text-left contact-info d-flex align-items-center
                                                fw-bold">
                                            <span class="icon">
                                                <?php echo
                                                    '<img class="icon" alt="Company Logo" src="
                                        ' . URL_ROOT . '/public/img/icons/other/location.png" 
                                        height="100%" width="100%"' . '>'
                                                ?>
                                            </span>
                                                    <span class="px-2">
                                                <?php echo $this->data["manufacturer"]->address ?>
                                            </span>
                                                </div>
                                                <div class="col-6 text-left contact-info d-flex align-items-center
                                                fw-bold">
                                            <span class="icon-wrapper">
                                                <?php echo
                                                    '<img class="icon" alt="Company Logo" src="
                                        ' . URL_ROOT . '/public/img/icons/other/phone.png" 
                                        height="100%" width="100%"' . '>'
                                                ?>
                                            </span>
                                                    <span class="px-2">
                                                <?php echo $this->data["manufacturer"]->contact_no ?>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row description col-12 text-justify p-2">
                                        <?php echo $this->data["manufacturer"]->description ?>
                                    </div>
                                </div>
                                <div class="col-2 d-flex text-center align-items-center justify-content-center">
                                    <div class="col-12 product-count-wrapper p-4">
                                <span class="product-count fw-bold">
                                    <?php echo sizeof($this->data["product"]) ?>
                                </span><br>
                                        <span class="fw-bold fs-4">Products</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3">
                        <?php
                        include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php"; ?>
                    </div>

                    <div class="category-selector row col-12">
                        <?php foreach ($this->data["productCategory"] as $productCategory) {
                            echo '<a href="#' . $productCategory->category_id . '">
                             <div class="category-wrapper col-2 px-2 pt-2 d-flex">
                                <div class="col-12 category p-2 align-items-center justify-content-center d-flex">
                                        <div class="text-center">
                                            <span class="pt-2 pb-0 product-name fw-bold">
                                            ' . $productCategory->category_name . ' </span>
                                        </div>
                                </div>
                                </a>
                            </div>';
                        }
                        ?>
                    </div>

                    <div class="products-wrapper">
                        <br>
                        <?php
                        foreach ($this->data["productCategory"] as $productCategory) { ?>
                            <section class="row pt-2" id="<?php echo $productCategory->category_id ?>">
                            <span class="fw-bold text-justify text-primary-dark px-2 pt-3 fs-5">
                                <?php echo $productCategory->category_name?>
                                <br>
                            </span>
                            </section>
                            <div class="col-4 px-2 pt-1 pb-2 fw-bold text-primary-dark">
                                <hr>
                            </div>
                            <div class="row">
                                <?php foreach ($this->data["product"] as $product) {
                                    if ($product->category_id == $productCategory->category_id) {
                                        echo '<div class="col-2 text-center p-2">
                                    <div class="product-card p-3 pb-2">
                                        <div class="image-window mb-1">
                                            ' .
                                            '<img alt="Product image" height="100%" width="100%" src="' . URL_ROOT .
                                            '/public/img/products/' .
                                            $product->image_url . '">'
                                            . '
                                        </div>
                                        <div class="text-center">
                                            <span class="pt-2 pb-0 product-name fw-bold">' .
                                            $product->product_name . '</span>
                                            <h4 class="product-price text-light-green py-1 pb-2">'
                                            . $product->unit_price . '</h4>
                                            
                                        </div>
                                    </div>
                                </div>
                                <br>';
                                    }
                                }
                                ?>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <div class="p-4 text-right">
                <?php echo '<a href="' . URL_ROOT . '/manufacturerStore">
                    <img class="up-arrow-icon" alt="Up" src="
                       ' . URL_ROOT . '/public/img/icons/other/up_arrow.png" 
                       height="100%" width="100%"> </a>'
                ?>
            </div>
            <?php
            include APP_ROOT . "/views/inc/components/Footer.php";
            ?>
        </main>
    </div>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


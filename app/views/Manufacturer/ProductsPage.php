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

            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 pt-1 justify-content-space-between">
                            <div class="col-6">
                                <h1 class="title">Products</h1>
                            </div>
                            <div class="col">
                                <?php echo '<a class="btn-md btn-primary-light text-center text-white" 
                                    href = "' . URL_ROOT . '/products/add">Add Product</a>'
                                ?>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";?>
                                <div class="products-wrapper d-flex">
                                    <div class="row col-12 d-flex gap-1 mb-4">
                                    <?php
                                    foreach ($this->data as $product) {
                                        ?>
                                        <div class="col-2">
                                            <div class="product-card pb-2 p-3">
                                                <div class="rating-box px-1 d-flex">
                                                    <span class="rating-icon">
                                                    <?php echo '<img src="' . URL_ROOT . '
                                                    /public/img/icons/other/rating-icon.png" height="80%" width="80%">'
                                                    ?>
                                                    </span>
                                                    <span class="rating-text fw-bold">
                                                        <?php echo $product->rating ?>
                                                    </span>
                                                </div>
                                                <div class="image-window mb-1">
                                                    <?php echo '<div class="image-window mb-1">
                                                        ' . '<img class="ml-2 pr-3" alt="Product image" 
                                                        height="100%" width="100%" 
                                                        src="' . URL_ROOT . '/public/img/products/' .
                                                        $product->image_url . '">' . '
                                                        </div>'
                                                    ?>
                                                </div>
                                                <div class="text-center">
                                                    <h4 class="pt-2 pb-0 product-name fw-bold">
                                                        <?php echo $product->product_name; ?>
                                                    </h4>
                                                    <h5 class="text-secondary py-1 product-category fw-bold">
                                                        <?php echo $product->category_name; ?>
                                                    </h5>
                                                    <div class="fw-bold text-center justify-content-center
                                                        align-items-center d-flex">
                                                        <div class="product-qty px-3 fs-2">Qty in Stock :
                                                            <span class="fs-3"><?php echo $product->stock_qty; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="text-primary-light py-1 fw-bold">
                                                        <?php echo $product->unit_price; ?></div>
                                                    <div class="row justify-content-center align-items-center
                                                        gap-1 d-flex">
                                                        <div class="col">
                                                            <?php echo '<a class="btn-xs btn-outlined-primary-dark 
                                                        text-center" 
                                                        href = "' . URL_ROOT . '/products/edit/' .
                                                                $product->product_id . '">Edit</a>' ?>
                                                        </div>

                                                        <div class="col"><?php echo '<a class="btn-xs btn-outlined-error
                                                        text-center" 
                                                        href = "' . URL_ROOT . '/products/hide/' .
                                                                $product->product_id . '">Hide</a>' ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            Table View-->

<!--            <table>-->
<!--                <thead>-->
<!--                <tr class="row">-->
<!--                    <th class="col-1"></th>-->
<!--                    <th class="col-3">Category</th>-->
<!--                    <th class="col-3">Product</th>-->
<!--                    <th class="col-1">Quantity in stock</th>-->
<!--                    <th class="col-2">Unit price</th>-->
<!--                    <th class="col-2"></th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                --><?php
//                foreach ($this->data as $product) {
//                    ?>
<!--                    <tr class="row">-->
<!--                        <td class="col-1">-->
<!--                            --><?php //echo '<div class="image-window mb-1">
//                                    ' . '<img class="ml-2 mt-2 pr-3" alt="Product image" height="100%"
//                                                width="100%" src="' . URL_ROOT . '/public/img/products/' .
//                                $product->image_url . '">' . '
//                                    </div>'
//                            ?><!--</td>-->
<!--                        <td class="col-3">--><?php //echo $product->category_name; ?><!--</td>-->
<!--                        <td class="col-3">--><?php //echo $product->product_name; ?><!--</td>-->
<!--                        <td class="col-1">--><?php //echo $product->stock_qty; ?><!--</td>-->
<!--                        <td class="col-2">--><?php //echo $product->unit_price; ?><!--</td>-->
<!--                        <td class="col-2 pr-3">-->
<!--                            <div class="row justify-content-end align-items-center gap-1">-->
<!--                                <div class="col">-->
<!--                                    --><?php //echo '<a class="btn-xs btn-outlined-primary-dark
//                                                        text-center"
//                                                        href = "' . URL_ROOT . '/products/edit/' .
//                                        $product->product_id . '">Edit</a>' ?>
<!--                                </div>-->
<!---->
<!--                                <div class="col">-->
<!--                                    --><?php //echo '<a class="btn-xs btn-outlined-error
//                                                        text-center"
//                                                        href = "' . URL_ROOT . '/products/hide/' .
//                                        $product->product_id . '">Hide</a>' ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    --><?php
//                }
//                ?>
<!--                </tbody>-->
<!--                <tfoot>-->
<!--                <tr class="row justify-content-end pagination">-->
<!--                    <td class="col-3 text-right"><span>Rows per page:</span><label>-->
<!--                            <select name="table_filter" id="table_filter">-->
<!--                                <option value="">10</option>-->
<!--                            </select>-->
<!--                        </label></td>-->
<!--                    <td class="col-2">1-2 of 25-->
<!--                        <span class="arrow-icons">-->
<!--                                                <span class="left-arrow">-->
<!--                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"-->
<!--                                                         xmlns="http://www.w3.org/2000/svg">-->
<!--                                                    <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"-->
<!--                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"-->
<!--                                                          stroke-linejoin="round"/>-->
<!--                                                </svg>-->
<!--                                                </span>-->
<!---->
<!--                                                <span class="right-arrow">-->
<!--                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"-->
<!--                                                         xmlns="http://www.w3.org/2000/svg">-->
<!--                                                    <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"-->
<!--                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"-->
<!--                                                          stroke-linejoin="round"/>-->
<!--                                                </svg>-->
<!--                                                </span>-->
<!--                                            </span>-->
<!--                    </td>-->
<!--                </tfoot>-->
<!--            </table>-->

            <div class="hidden-products-wrapper px-4 py-1">
                <button class="btn-hidden-products text-primary-light fs-3 p-2 px-3 d-flex"
                        id="hidden-products-toggle" value="show">Show hidden products
                </button>
                <div class="d-flex mt-2 product-card-wrapper row col-12 gap-1 pl-3 mb-4" id="hidden-products"></div>
            </div>

            <?php
            include APP_ROOT . "/views/inc/components/Footer.php";
            ?>
        </main>
    </div>
    <script src="<?php echo URL_ROOT ?>/public/js/hiddenProducts.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


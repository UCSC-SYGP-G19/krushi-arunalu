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
                        <div class="row px-1 pt-1">
                            <div class="col-10">
                                <h1 class="title">Product Categories Page</h1>
                            </div>
                            <div class=col-2">
                                <a href="product-category/add" class="btn-primary-light text-white">
                                    Add Product Category</a>
                            </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>

                                    <br>
                                    <table>
                                        <thead>
                                        <tr class="row">
                                            <th class="col-4">Category Name</th>
                                            <th class="col-6">Description</th>
                                            <th class="col-2"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($this->data as $product_category) {
                                            ?>
                                            <tr class="row">
                                                <td class="col-4"><?php echo $product_category->getName() ?></td>
                                                <td class="col-6"><?php echo $product_category->getDescription(); ?>
                                                </td>
                                                <td class="col-2 pr-3">
                                                    <div class="row justify-content-end align-items-center gap-1">
                                                        <div class="col">
                                                            <a href='edit/<?php echo $product_category->getId(); ?>'
                                                               class="btn-xs btn-outlined-primary-dark text-center">
                                                                Edit
                                                            </a>

                                                        </div>
                                                        <div class="col">
                                                            <a href='delete/<?php echo $product_category->getId(); ?>'
                                                               class="btn-xs btn-outlined-primary-dark text-center">
                                                                Hide
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr class="row justify-content-end pagination">
                                            <td class="col-3 text-right"><span>Rows per page:</span><label>
                                                    <select name="table_filter" id="table_filter">
                                                        <option value="">10</option>
                                                    </select>
                                                </label></td>
                                            <td class="col-2">1-2 of 25
                                                <span class="arrow-icons">
                                                <span class="left-arrow">
                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"
                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                </span>

                                                <span class="right-arrow">
                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"
                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                </span>
                                            </span>
                                            </td>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

<!--                                <ul>-->
<!--                                    --><?php //foreach ($this->data as $category) {
//                                        echo '<li>' . $category->getName() . '</li>';
//                                    }?>
<!--                                </ul>-->
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


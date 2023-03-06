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
                                <h1 class="title">Purchased Stocks</h1>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";?>
                                <table>
                                    <thead>
                                    <tr class="row">
                                        <th class="col-2">Stock Item ID</th>
                                        <th class="col-2">Category</th>
                                        <th class="col-2">Crop Name</th>
                                        <th class="col-2">Quantity</th>
                                        <th class="col-2">Last Purchased Date</th>
                                        <th class="col-2"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row">
                                            <td class="col-2">1</td>
                                            <td class="col-2">Spices</td>
                                            <td class="col-2">Cinnamon</td>
                                            <td class="col-2">10KG</td>
                                            <td class="col-2">23-01-2023</td>
                                            <td class="col-2 pr-3">
                                                <div class="row justify-content-end align-items-center gap-1">
                                                    <div class="col">
                                                        <a href='edit/<?php echo $stock_item_id->id; ?>'
                                                           class="btn-xs btn-outlined-primary-dark text-center">
                                                            Edit
                                                        </a>

                                                    </div>
                                                    <div class="col">
                                                        <a href='delete/<?php echo $stock_item_id->id; ?>'
                                                           class="btn-xs btn-outlined-secondary text-center">
                                                            Hide
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-2">2</td>
                                            <td class="col-2">Spices</td>
                                            <td class="col-2">Cinnamon</td>
                                            <td class="col-2">10KG</td>
                                            <td class="col-2">28-12-2022</td>
                                            <td class="col-2 pr-3">
                                                <div class="row justify-content-end align-items-center gap-1">
                                                    <div class="col">
                                                        <a href='edit/<?php echo $stock_item_id->id; ?>'
                                                           class="btn-xs btn-outlined-primary-dark text-center">
                                                            Edit
                                                        </a>

                                                    </div>
                                                    <div class="col">
                                                        <a href='delete/<?php echo $stock_item_id->id; ?>'
                                                           class="btn-xs btn-outlined-secondary text-center">
                                                            Hide
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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


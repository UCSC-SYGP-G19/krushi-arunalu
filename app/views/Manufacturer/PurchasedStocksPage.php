<?php
include APP_ROOT . "/views/inc/components/Header.php";

?>

    <body class="overflow-hidden full-height">
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
                                        <th class="col-3">Last Purchased Date</th>
                                        <th class="col-1"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->data as $stockItem) { ?>
                                        <tr class="row">
                                            <td class="col-2"><?php echo $stockItem->crop_id ?></td>
                                            <td class="col-2"><?php echo $stockItem->category_name ?></td>
                                            <td class="col-2"><?php echo $stockItem->crop_name ?></td>
                                            <td class="col-2"><?php echo $stockItem->purchased_qty ?></td>
                                            <td class="col-3"><?php echo $stockItem->last_purchased_date ?></td>
                                            <td class="col-1 pr-5">
                                                <div class="row justify-content-end align-items-center gap-1">
                                                    <div class="col">
                                                        <a href='hide/<?php echo $stockItem->crop_id; ?>'
                                                           class="btn-xs btn-outlined-error text-center">
                                                            Hide
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
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


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
                                <h1 class="title">Producers</h1>
                            </div>
                            <div class="col">
                                <a href="producers/received-connection-requests"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Connection Requests</a>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <span class="px-1 pt-3 fs-4 fw-bold">
                                <a href="#" class="active-page" id="btn-all-producers">All</a>
                            </span>
                            <span class="px-1 pt-3 fs-4 fw-bold mx-4">
                                <a href="#" class="inactive-page" id="btn-connected-producers">Connected</a>
                            </span>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";?>
                                <table>
                                    <thead>
                                    <tr class="row">
                                        <th class="col-2">Producer ID</th>
                                        <th class="col-4">Producer Name</th>
                                        <th class="col-4">Cultivating Crops</th>
                                        <th class="col-2"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="producers-table">
                                        <tr class="py-3">
                                            <td>Loading</td>
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
    <script src="<?php echo URL_ROOT ?>/public/js/Manufacturer/viewProducers.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";

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
                                <h1 class="title">Crop Prices</h1>
                            </div>
                            <div class="container">
                                <div class="row justify-content-end pt-1 pb-3">
                                    <div class="col-3">
                                        <form class="px-2 py-2">
                                            <label for="Date">Date:</label>
                                            <input type="date" id="Date" name="Date" onchange="updateUrl()"
                                                   max="<?php echo date('Y-m-d'); ?>">
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php foreach ($this->data["crops"] as $crop) { ?>
                                        <div class="col-6 px-2 py-2">
                                            <div class="product-card px-4 py-4">
                                                <img src="crop-image-1.jpg" class="card-img-top" alt="Crop Image 1">
                                                <div class="card-body">
                                                    <h2 class="card-title"><?php echo $crop->name; ?></h2>
                                                    <ul>
                                                        <?php foreach ($this->data["marketPrices"][$crop->id] as $row) { ?>
                                                            <li><?php echo $row->market_name . " : <strong> Rs. " . $row->low_price . " - Rs. " . $row->high_price . "</strong>"; ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                    <form class="row gap-2 justify-content-center">
                                                        <div class="form-section-title col-6">
                                                            <label for="max-price-1">Enter the Maximum Price:</label>
                                                            <input type="text" id="max-price-1" name="max-price-1">
                                                        </div>
                                                        <div class="form-section-title col-6">
                                                            <label for="max-price-1">Enter the Minimum Price:</label>
                                                            <input type="text" id="max-price-1" name="max-price-1">
                                                        </div>
                                                        <button type="submit"
                                                                class="btn-lg btn-primary-light mt-3 text-center text-white">
                                                            Submit
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
    <script>
        function updateUrl() {
            let date = document.getElementById("datepicker").value;
            let url = "search.php?date=" + encodeURIComponent(date);
            window.history.replaceState(null, null, url);
        }
    </script>
    <script src="<?php echo URL_ROOT ?>/public/js/AgriOfficer/cropPrices.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
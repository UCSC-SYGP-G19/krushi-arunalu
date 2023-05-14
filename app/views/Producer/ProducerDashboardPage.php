<?php

include APP_ROOT . "/views/inc/components/Header.php";
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/1.30.1/date_fns.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

    </script>
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
                    <div class="container-fluid px-2 producer-dashboard">
                        <div class="row px-1 pt-1 pb-1">
                            <div class="col-12">
                                <h1 class="title">Producer Dashboard</h1>
                            </div>
                        </div>
                        <div class="row px-1 py-3 gap-3">
                            <div class="col-12 col-6-md">
                                <div class="dashboard-card px-4 py-4 m-auto min-h-100">
                                    <h3 class="pb-2 text-center fw-normal">Best cultivations for your land:&ensp;
                                        <select name="land" id="land_dropdown"
                                                data-selected-id="<?php if (isset($this->fields['land'])) {
                                                    echo $this->fields['land'];
                                                                  } ?>">
                                            <?php foreach ($this->fieldOptions["land"] as $option) {
                                                echo '<option value="' . $option->id . '"'
//                                                    ((isset($this->fields['crop']) &&
//                                                        $this->fields['crop'] == $option->id) ? 'selected' : '')
                                                    . '>' . $option->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </h3>
                                    <hr class="primary-color my-1">
                                    <div class="pt-3 pb-0 px-3" id="best-cultivations-container">
                                        <?php if (!isset($this->fieldOptions['land']) || $this->fieldOptions['land'] == []) {
                                            echo '<div class="m-4"><h5>
                                            You have not entered any land details yet</h5></div>';
                                        } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-6-md">
                                <div class="dashboard-card p-4 m-auto min-h-100">
                                    <h4 class="pb-2 text-center fw-normal">Prices for&ensp;
                                        <select name="agri_officer_prices_district"
                                                id="agri_officer_prices_district_dropdown"
                                                data-selected-id="">
                                            <?php foreach ($this->fieldOptions["district"] as $option) {
                                                echo '<option value="' . $option->id . '"'
                                                    . '>' . $option->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                        &ensp;on:&ensp;
                                        <input type="date" name="agri_officer_prices_date"
                                               id="agri_officer_prices_date_picker">
                                    </h4>
                                    <hr class="primary-color my-1">
                                    <p class="text-center text-secondary fs-2 mt-2 mb-1">(Prices set by
                                        agri-officers)</p>
                                    <div class="pt-2 pb-0 px-3" id="agri-officer-set-prices-container">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row px-1 py-2">
                            <h2 class="col-12 text-center fw-normal mb-1">Crop Analytics</h2>

                            <div class="col-12 mb-2">
                                <div class="row gap-2 mb-2 justify-content-center">
                                    <div class="col-12 col-8-sm col-6-md col-4-lg">
                                        <label for="crop_dropdown">Crop</label>
                                        <select name="crop" id="crop_dropdown"
                                                data-selected-id="<?php if (isset($this->fields['crop'])) {
                                                    echo $this->fields['crop'];
                                                                  } ?>">
                                            <option value="">Select crop</option>
                                            <?php foreach ($this->fieldOptions["crop"] as $option) {
                                                echo '<option value="' . $option->id . '"'
//                                                    ((isset($this->fields['crop']) &&
//                                                        $this->fields['crop'] == $option->id) ? 'selected' : '')
                                                    . '>' . $option->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-8-sm col-6-md col-4-lg">
                                        <label for="crop_market_dropdown">Market</label>
                                        <select name="crop_market" id="crop_market_dropdown"
                                                data-selected-id="<?php if (isset($this->fields['crop_market'])) {
                                                    echo $this->fields['crop_market'];
                                                                  } ?>">
                                            <option value="">Select market</option>
                                            <?php foreach ($this->fieldOptions["crop_market"] as $option) {
                                                echo '<option value="' . $option->id . '"'
//                                                    ((isset($this->fields['crop_market']) &&
//                                                        $this->fields['crop_market'] == $option->id) ? 'selected' : '')
                                                    . '>' . $option->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-8-sm col-6-md col-4-lg">
                                        <label for="district_dropdown">District</label>
                                        <select name="district" id="district_dropdown"
                                                data-selected-id="<?php if (isset($this->fields['district'])) {
                                                    echo $this->fields['district'];
                                                                  } ?>">
                                            <option value="">Select district</option>
                                            <?php foreach ($this->fieldOptions["district"] as $option) {
                                                echo '<option value="' . $option->id . '"'
//                                                    ((isset($this->fields['crop_market']) &&
//                                                        $this->fields['crop_market'] == $option->id) ? 'selected' : '')
                                                    . '>' . $option->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <h3 class="col-12 text-center fw-bold mb-2 text-primary-light py-2">Price
                                        variation</h3>
                                </div>

                                <div class="row dashboard-card p-3">
                                    <div class="col-12" id="chart-container-1">
                                        <div class="canvas-wrapper py-1 px-2">
                                        </div>
                                        <div class="row justify-content-center gap-0 row text-center text-secondary pt-2 pb-3"
                                             id="chart-hints">
                                            <div class="col-12 pt-2 pb-1">
                                                <p class=" text-center">
                                                    Select a crop and a market to view wholesale prices reported by
                                                    <abbr
                                                            class="d-inline"
                                                            title="Hector Kobbekaduwa Agrarian Research and Training Institute">
                                                        HARTI</abbr>.
                                                </p>
                                            </div>
                                            <div class="col-12 pb-2">
                                                <p class="text-center">
                                                    Select a crop and a district to view wholesale prices set by
                                                    agri-officers.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-none data-courtesy-tag my-2 pt-2">
                                    <div class="col-12 text-right">
                                        <p class="fs-2">
                                            Data courtesy of <a target="_blank"
                                                                href="http://www.harti.gov.lk/index.php/en/market-information/data-food-commodities-bulletin">
                                                Hector Kobbekaduwa Agrarian Research and Training Institute</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center py-2 gap-3">
                            <h2 class="col-12 text-center fw-normal mt-1 py-2">Current land utilisation</h2>
                            <div class="min-w-100 d-flex justify-content-center" id="land-charts-container">
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
    <script src="<?php echo URL_ROOT ?>/public/js/Producer/dashboard.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";

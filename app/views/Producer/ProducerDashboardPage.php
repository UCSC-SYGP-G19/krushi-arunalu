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
                                <div class="dashboard-card px-4 py-3 m-auto">
                                    <h3 class="pb-2 pt-1 text-center fw-normal">Best cultivations for your land 1</h3>
                                    <hr class="primary-color">
                                    <div class="pt-3 pb-0 px-3">
                                        <ul>
                                            <li class="py-1 row">
                                                <div class="col-2">
                                                    <div class="crop-pic-rounded"
                                                         style="background-image: url('<?php echo URL_ROOT ?>/public/img/crops/pepper.jpg')">
                                                    </div>
                                                </div>
                                                <div class="col-10 pl-2 m-auto">
                                                    <h4 class="fw-bold">Heading</h4>
                                                    <h5 class="fw-normal">Subheading</h5>
                                                </div>
                                            </li>

                                            <li class="py-1 row">
                                                <div class="col-2">
                                                    <div class="crop-pic-rounded"
                                                         style="background-image: url('<?php echo URL_ROOT ?>/public/img/crops/pepper.jpg')">
                                                    </div>
                                                </div>
                                                <div class="col-10 pl-2 m-auto">
                                                    <h4 class="fw-bold">Heading</h4>
                                                    <h5 class="fw-normal">Subheading</h5>
                                                </div>
                                            </li>

                                            <li class="py-1 row">
                                                <div class="col-2">
                                                    <div class="crop-pic-rounded"
                                                         style="background-image: url('<?php echo URL_ROOT ?>/public/img/crops/pepper.jpg')">
                                                    </div>
                                                </div>
                                                <div class="col-10 pl-2 m-auto">
                                                    <h4 class="fw-bold">Heading</h4>
                                                    <h5 class="fw-normal">Subheading</h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-6-md">
                                <div class="dashboard-card p-4">
                                    <ul class="pl-2">
                                        <li class="py-1 row">
                                            <div class="col-6">
                                                <h4 class="fw-bold">Heading</h4>
                                                <h5 class="fw-normal">Subheading</h5>
                                            </div>
                                            <div class="col-6">
                                                <h4 class="fw-bold text-primary-light">Rs. XXX - Rs. XXX</h4>
                                                <h5 class="fw-normal">Per KG</h5>
                                            </div>
                                        </li>

                                        <li class="py-1 row">
                                            <div class="col-6">
                                                <h4 class="fw-bold">Heading</h4>
                                                <h5 class="fw-normal">Subheading</h5>
                                            </div>
                                            <div class="col-6">
                                                <h4 class="fw-bold text-primary-light">Rs. XXX - Rs. XXX</h4>
                                                <h5 class="fw-normal">Per KG</h5>
                                            </div>
                                        </li>
                                        <li class="py-1 row">
                                            <div class="col-6">
                                                <h4 class="fw-bold">Heading</h4>
                                                <h5 class="fw-normal">Subheading</h5>
                                            </div>
                                            <div class="col-6">
                                                <h4 class="fw-bold text-primary-light">Rs. XXX - Rs. XXX</h4>
                                                <h5 class="fw-normal">Per KG</h5>
                                            </div>
                                        </li>

                                        <li class="py-1 row">
                                            <div class="col-6">
                                                <h4 class="fw-bold">Heading</h4>
                                                <h5 class="fw-normal">Subheading</h5>
                                            </div>
                                            <div class="col-6">
                                                <h4 class="fw-bold text-primary-light">Rs. XXX - Rs. XXX</h4>
                                                <h5 class="fw-normal">Per KG</h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row px-1 py-3">
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

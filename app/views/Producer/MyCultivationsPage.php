<?php

include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto bg-grey">
<?php
include APP_ROOT . "/views/inc/components/LoggedInNavbarWithoutSidebar.php"
?>

<main class="container py-3 my-cultivations-page">
    <section class="section-wrapper p-3 px-4 mb-4 mt-2">
        <div class="row justify-content-center mt-3 mb-2">
            <div class="col-12 py-2 px-4">
                <div class="row justify-content-center">
                    <h2 class="text-primary-light">Land and Cultivation details</h2>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-2">
                <div class="row mb-1 justify-content-center">
                    <div class="col-11">
                        <hr>
                    </div>
                </div>

                <div class="inner-card row px-0 mt-3 mb-1 pb-1">
                    <div class="col-12 text-center text-primary-light pb-3 pt-1"><h4
                                class="text-secondary fs-4 fw-normal">Existing cultivation data</h4></div>
                    <div class="col-12 request-responses-list">
                        <div class="row mb-1 mt-1 px-2 justify-content-center">
                            <?php
                            function renderCultivationCards($landId, $cultivations): string
                            {

                                $output = '<div class="row justify-content-start overflow-x-auto">
                                <div class="col-12 d-flex gap-1 mb-1 text-center justify-content-start">';
                                if (count($cultivations) > 0) {
                                    foreach ($cultivations as $cultivation) {
                                        $min = strtotime($cultivation->cultivated_date);
                                        $current = strtotime(date("y-m-d"));
                                        $max = strtotime($cultivation->expected_harvest_date);
                                        $value = $current >= $max ? 100 : ($current - $min) / ($max - $min) * 100;
                                        if ($cultivation->land_id = $landId) {
                                            $output .= '
                                        <div class="col-4">
                                            <div class="crop-card p-2 pt-3 pb-3">
                                                <div class="text-center">
                                                    <h4 class="pt-0 pb-1 product-name fw-bold">
                                                        ' . $cultivation->crop_name . '
                                                    </h4>
                                                    <div class="fw-bold text-center justify-content-center
                                                        align-items-center d-flex mt-1 mb-2">
                                                        <div class="product-qty px-3 py-1 fs-2">Cultivated area:
                                                            <span class="fs-2">' . $cultivation->cultivated_area .
                                                ' acres</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                    
                                                    <div class="m-auto mb-2 mt-3 p-1 pt-0">
                                                    <div class="m-auto" role="progressbar" aria-valuenow="' .
                                                $value . '" aria-valuemin="' . 0 . '" aria-valuemax="' . 100 .
                                                '" style="--value: ' . round($value) . '"></div>
                                                    
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="mt-1 fs-2 text-secondary">
                                                        Cultivated date: ' . $cultivation->cultivated_date . '</div>
                                                    <div class="fs-2 text-secondary">
                                                        Expected harvest date: ' . $cultivation->expected_harvest_date . '</div>    
                                                    <div class="mt-2 row justify-content-center align-items-center 
                                                    gap-1 d-flex">
                                                        <div class="col">
                                                        <a class="btn-xs btn-outlined-primary-dark text-center fs-2 p-1 px-2" 
                                                        href = "' . URL_ROOT . '/cultivations/edit/' .
                                                $cultivation->cultivation_id . '">
                                                        Edit
                                                        </a>
                                                        </div>

                                                        <div class="col">
                                                        <a class="btn-xs btn-outlined-error-dark text-center fs-2 p-1 px-2" 
                                                        href = "' . URL_ROOT . '/cultivations/delete/' .
                                                $cultivation->cultivation_id . '">
                                                        Delete
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                        }
                                    }
                                } else {
                                    $output .= '<h5 class="fw-normal">You have not added any cultivations to this land yet</h5>';
                                }

                                $output .= '<div class="col-2 pt-4 mt-2">
                                            <div class="crop-card p-2 pt-5 faded">
                                                <a href="' . URL_ROOT . '/cultivations/add/' . '" class="add-icon">
<svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M36 17.1104V54.8881" stroke="#D9D9D9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17.1094 36H54.8871" stroke="#D9D9D9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M36 70C54.7778 70 70 54.7778 70 36C70 17.2223 54.7778 2 36 2C17.2223 2 2 17.2223 2 36C2 54.7778 17.2223 70 36 70Z" stroke="#D9D9D9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                                </a>
                                            </div>
                                        </div>';

                                $output .= '</div></div>';
                                return $output;
                            }

                            if (count($this->data["landDetails"]) > 0) {
                                foreach ($this->data["landDetails"] as $row) {
                                    echo '<div class="col-11 card-content py-3 px-4 mb-3" id="land-card-"' .
                                        $row->land_id . '>
                                <div class="row pb-1">
                                    <div class="col-12">
                                        <div class="row align-items-center">
                                            <div class="col-6 text-black fw-bold mb-1">
                                                <h3>' . $row->land_name . ' </h3>
                                            </div>
                                            <div class="col-6 text-primary-light fw-bold text-right">
                                                <span>' . $row->land_area_in_acres . ' acres</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-grey-dark pb-2">
                                        <span class="pr-1 text-gold"><em>' . $row->land_address . '</em></span>
                                    </div>
                                    <hr class="hr-primary">
                                </div>' . renderCultivationCards($row->land_id, $this->data["cultivationDetails"]) .
                                        '</div>';
                                }
                            } else {
                                echo '<div class="m-4 mt-3 fw-normal"><h5>No land data added yet</h5></div>';
                            }
                            ?>


                        </div>
                    </div>
                </div>

                <div class="row mt-0 mb-4 justify-content-center align-items-center">
                    <div class="col-11">
                        <hr>
                    </div>
                </div>

                <div class="row justify-content-center pt-0 pb-2">
                    <div class="col-12 justify-content-center text-center">
                        <a href="<?php echo URL_ROOT ?>/my-lands"
                           class="mr-2 btn-lg btn-outlined-primary-light text-center fs-3">Go to lands&ensp;
                            <svg width="15" height="12" viewBox="0 0 20 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.75 8H1.25" stroke-width="2" stroke-linecap="round" stroke="#15742D"
                                      stroke-linejoin="round"/>
                                <path d="M11.75 15L18.75 8L11.75 1" stroke-width="2" stroke-linecap="round"
                                      stroke="#15742D"
                                      stroke-linejoin="round"/>
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo URL_ROOT ?>/public/js/Producer/myLands.js" defer></script>

</body>
<?php
include APP_ROOT . "/views/inc/components/Footer.php"
?>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
?>

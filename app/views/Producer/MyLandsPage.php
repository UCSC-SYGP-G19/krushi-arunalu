<?php

use app\views\inc\components\InputField;
use app\views\inc\components\SelectField;

include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto bg-grey">
<?php
include APP_ROOT . "/views/inc/components/LoggedInNavbarWithoutSidebar.php"
?>

<main class="container py-3 my-lands-page">
    <section class="section-wrapper p-3 px-4 mb-4 mt-3">
        <div class="row justify-content-center mt-3 mb-2">
            <div class="col-12 py-2 px-4">
                <div class="row justify-content-center">
                    <h2 class="text-primary-light">Land and Cultivation details</h2>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-1 mb-2">
                <div class="row mb-1 justify-content-center">
                    <div class="col-11">
                        <hr>
                    </div>
                </div>

                <div class="inner-card row px-3 mt-3 mb-2 pb-2">
                    <div class="col-12 text-center text-primary-light pb-3 pt-1"><h4
                                class="text-secondary fs-4 fw-normal">Existing land data</h4></div>
                    <div class="col-12 request-responses-list">
                        <div class="row mb-1 mt-1 px-2 justify-content-center">

                            <?php
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
                                                <span class="ml-3">
                                      <button class="btn-xs btn-outlined-secondary mr-1 edit-button"
                                              onclick="handleLandEditClick(' . $row->land_id . ')">
                                        Edit
                                    </button>
                                    <button class="btn-xs btn-outlined-error ml-1 delete-button"
                                            onclick="handleLandDeleteClick(' . $row->land_id . ')">
                                        Delete
                                    </button>
                                  </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-grey-dark pb-2">
                                        <span class="pr-1 text-gold"><em>' . $row->land_address . '</em></span>
                                    </div>
                                    <div class="col-4 d-flex fs-3 text-grey-dark pt-1">
                                        <span class="pr-1">Soil condition : </span>
                                        <span class="accepted-quantity fw-bold text-black">' .
                                        $row->land_soil_condition .
                                        '</span>
                                    </div>
                                    <div class="col-4 d-flex fs-3 text-grey-dark">
                                        <span class="pr-1">Rainfall : </span>
                                        <span class="accepted-quantity fw-bold text-black">' .
                                        $row->land_rainfall .
                                        '</span>
                                    </div>
                                    <div class="col-4 d-flex fs-3 text-grey-dark">
                                        <span class="pr-1">Humidity : </span>
                                        <span class="accepted-quantity fw-bold text-black">' .
                                        $row->land_humidity .
                                        '</span>
                                    </div>
                                </div>
                            </div>';
                                }
                            } else {
                                echo '<div class="m-4 mt-3 fw-normal"><h5>No land data added yet</h5></div>';
                            }
                            ?>


                        </div>
                    </div>
                </div>

                <div class="row my-1 justify-content-center align-items-center">
                    <div class="col-11">
                        <hr>
                    </div>
                </div>

                <div class="row pt-3 pb-3 px-2 justify-content-center align-items-center">
                    <div class="col-12 px-5">
                        <div class="col-12 text-center text-primary-light pb-3 pt-1"><h4
                                    class="text-secondary fs-4 fw-normal">Add new land data</h4></div>
                        <form action=""
                              method="POST">
                            <div class="row gap-2">
                                <?php

                                $this->fieldOptions["soil_condition"] = [
                                    (object)["id" => "Dry", "name" => "Dry"],
                                    (object)["id" => "Wet", "name" => "Wet"],
                                    (object)["id" => "Moderate", "name" => "Moderate"]
                                ];
                                $this->fieldOptions["rainfall"] = [
                                    (object)["id" => "Low", "name" => "Low"],
                                    (object)["id" => "Medium", "name" => "Medium"],
                                    (object)["id" => "High", "name" => "High"]
                                ];
                                $this->fieldOptions["humidity"] = [
                                    (object)["id" => "Low", "name" => "Low"],
                                    (object)["id" => "Medium", "name" => "Medium"],
                                    (object)["id" => "High", "name" => "High"]
                                ];

                                $formData = [
                                    "land_name" => [
                                        "element" => InputField::class,
                                        "wrapperClass" => "col-6",
                                        "label" => "Land name",
                                        "placeholder" => "Enter a name to identify this land",
                                    ],
                                    "land_size" => [
                                        "element" => InputField::class,
                                        "wrapperClass" => "col-3",
                                        "label" => "Land area (acres)",
                                        "type" => "number",
                                        "placeholder" => "Enter land area in acres",
                                    ],
                                    "district" => [
                                        "element" => SelectField::class,
                                        "wrapperClass" => "col-3",
                                        "label" => "District",
                                        "placeholder" => "Select district",
                                    ],
                                    "land_address" => [
                                        "element" => InputField::class,
                                        "wrapperClass" => "col-12",
                                        "label" => "Land address",
                                        "placeholder" => "Enter land address",
                                    ],
                                    "soil_condition" => [
                                        "element" => SelectField::class,
                                        "wrapperClass" => "col-4",
                                        "label" => "Soil condition",
                                        "placeholder" => "Select soil condition",
                                    ],
                                    "rainfall" => [
                                        "element" => SelectField::class,
                                        "wrapperClass" => "col-4",
                                        "label" => "Rainfall",
                                        "placeholder" => "Select rainfall level",
                                    ],
                                    "humidity" => [
                                        "element" => SelectField::class,
                                        "wrapperClass" => "col-4",
                                        "label" => "Humidity",
                                        "placeholder" => "Select humidity level",
                                    ]
                                ];

                                $this->generateFormFields($formData);
                                ?>
                            </div>
                            <div class="row gap-2 mt-4 mb-2 justify-content-center">
                                <input type="hidden" name="crop_request_id" value="2">
                                <button class="mr-2 btn-lg btn-primary-light text-center text-white fs-3" type="submit"
                                        name="submit_response" value="submit">Submit
                                </button>
                                <button class="ml-2 btn-lg btn-outlined-error text-center text-error fs-3" type="reset"
                                        name="cancel_response" value="cancel">Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--                    <div class="col-5 pl-1">-->
                    <!--                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31707.795967408147!2d79.97726!3d6.5877897999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2371ee59557e5%3A0x8b86ba840e8a7b51!2sGalle!5e0!3m2!1sen!2slk!4v1683971553969!5m2!1sen!2slk"-->
                    <!--                                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"-->
                    <!--                                referrerpolicy="no-referrer-when-downgrade"></iframe>-->
                    <!--                    </div>-->
                </div>

                <div class="row my-1 justify-content-center align-items-center">
                    <div class="col-11">
                        <hr>
                    </div>
                </div>

                <div class="row justify-content-center pt-3">
                    <div class="col-12 justify-content-center text-center">
                        <a href="<?php echo URL_ROOT ?>/my-cultivations"
                           class="mr-2 btn-lg btn-outlined-primary-light text-center fs-3">
                            Go to cultivations&ensp;

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

<?php

use app\views\inc\components\InputField;
use app\views\inc\components\SelectField;

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

            <div class="content-wrapper p-1">
                <div class="content p-4">
                    <div class="form-wrapper px-2">
                        <div class="row px-1 pt-1">
                            <div class="col-12 wrapper px-3 py-3">
                                <h2 class="title mt-2 py-1 text-center">Add new harvest</h2>
                                <form class=" mt-2 mb-1 px-2" action="" method="post">
                                    <h3 class="form-section-title">Cultivation details</h3>
                                    <div class="row gap-2">
                                        <?php

                                        $this->formData = [
                                            "cultivation" => [
                                                "element" => SelectField::class,
                                                "wrapperClass" => "col-4",
                                                "label" => "Cultivation",
                                                "placeholder" => "Select cultivation",
                                            ]
                                        ];

                                        foreach ($this->formData as $key => $value) {
                                            $formField = new $value["element"](
                                                $key,
                                                $value["label"],
                                                $value["placeholder"],
                                                $this->fields[$key] ?? null,
                                                $this->fieldErrors[$key] ?? null,
                                                $value["wrapperClass"],
                                            );
                                            isset($this->fieldOptions[$key]) &&
                                            $formField->options = $this->fieldOptions[$key];
                                            isset($value["type"]) && $formField->type = $value["type"];
                                            $formField->render();
                                        }
                                        ?>
                                    </div>
                                    <h3 class="form-section-title">Harvest details</h3>
                                    <div class="row gap-2">
                                        <?php
                                        $this->formData = [
                                            "harvested_date" => [
                                                "element" => InputField::class,
                                                "wrapperClass" => "col-4",
                                                "label" => "Harvested date",
                                                "placeholder" => "Select date",
                                                "type" => "date",
                                            ],
                                            "harvested_quantity" => [
                                                "element" => InputField::class,
                                                "wrapperClass" => "col-4",
                                                "label" => "Harvested quantity (KG)",
                                                "placeholder" => "Set harvested quantity",
                                                "type" => "number",
                                            ],
                                            "remaining_quantity" => [
                                                "element" => InputField::class,
                                                "wrapperClass" => "col-4",
                                                "label" => "Remaining quantity (KG)",
                                                "placeholder" => "Set remaining quantity",
                                                "type" => "number",
                                            ],
                                            "expected_price" => [
                                                "element" => InputField::class,
                                                "wrapperClass" => "col-4",
                                                "label" => "Expected price (Rs/KG)",
                                                "placeholder" => "Set expected price",
                                                "type" => "number",
                                            ],
                                        ];

                                        foreach ($this->formData as $key => $value) {
                                            $formField = new $value["element"](
                                                $key,
                                                $value["label"],
                                                $value["placeholder"],
                                                $this->fields[$key] ?? null,
                                                $this->fieldErrors[$key] ?? null,
                                                $value["wrapperClass"],
                                            );
                                            isset($this->fieldOptions[$key]) &&
                                            $formField->options = $this->fieldOptions[$key];
                                            isset($value["type"]) && $formField->type = $value["type"];
                                            $formField->render();
                                        }
                                        ?>
                                    </div>
                                    <?php if (isset($this->error)) { ?>
                                        <br>
                                        <div class="alert"><?php echo $this->error; ?></div>
                                    <?php } ?>
                                    <div class="mb-3 text-center">
                                        <button class="btn-lg btn-primary-light mt-3 mx-2 text-center text-white"
                                                type="submit" name="submit_page_1"
                                                value="register">Submit
                                        </button>
                                        <button class="btn-lg btn-outlined-error mt-3 mx-2 text-center"
                                                type="reset" name="cancel"
                                                value="cancel">Cancel
                                        </button>
                                    </div>
                                </form>
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

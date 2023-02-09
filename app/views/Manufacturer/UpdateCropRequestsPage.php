<?php

use app\views\inc\components\Table;
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

            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="form-wrapper p-4">
                            <h1 class="title text-black">Update crop request</h1>
                            <form class=" mt-2 mb-1 px-2" action="" method="post">
                                <div class="row gap-2">
                                    <?php
                                    $this->formData = [
                                        "crop_category" => [
                                            "element" => SelectField::class,
                                            "wrapperClass" => "col-4",
                                            "label" => "Category",
                                            "placeholder" => "Select Category",
                                        ],
                                        "crop" => [
                                            "element" => SelectField::class,
                                            "wrapperClass" => "col-8",
                                            "label" => "Crop(ingredient) name",
                                            "placeholder" => "Select crop",
                                        ],
                                        "required_quantity" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-6",
                                            "label" => "Set required quantity",
                                            "placeholder" => "Enter required quantity (KG)",
                                            "type" => "number",
                                        ],
                                        "low_price" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-3",
                                            "label" => "Expected price range",
                                            "placeholder" => "Low price",
                                            "type" => "number",
                                        ],
                                        "high_price" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-3 mt-4",
                                            "label" => "",
                                            "placeholder" => "High price",
                                            "type" => "number",
                                        ],
                                        "preferred_district" => [
                                            "element" => SelectField::class,
                                            "wrapperClass" => "col-6",
                                            "label" => "Preferred district",
                                            "placeholder" => "Select district",
                                        ],
                                        "required_date" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-6",
                                            "label" => "Required date",
                                            "placeholder" => null,
                                            "type" => "date",
                                        ],
                                        "description" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-12",
                                            "label" => "Description",
                                            "placeholder" => "Enter description",
                                            "type" => "text",
                                        ],
                                        "allow_multiple_producers" => [
                                            "element" => InputField::class,
                                            "wrapperClass" => "col-12",
                                            "label" => "Allow multiple producers to fulfill request",
                                            "placeholder" => "",
                                            "type" => "checkbox",
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
                                    <button class="btn-lg btn-primary-light mt-2 mx-2 text-center text-white"
                                            type="submit" name="submit_page_1"
                                            value="register">Submit
                                    </button>
                                    <button class="btn-lg btn-outlined-error mt-2 mx-2 text-center"
                                            type="reset" name="cancel"
                                            value="cancel">Cancel
                                    </button>
                                </div>
                            </form>
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


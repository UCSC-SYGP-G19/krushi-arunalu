<?php

use app\views\inc\components\InputField;
use app\views\inc\components\SelectField;

include APP_ROOT . "/views/inc/components/Header.php";

if (!isset($this->user)) {
    echo "You are not logged in, please <a href='./login'>login</a>";
}

?>

<body class="overflow-hidden full-height" xmlns="http://www.w3.org/1999/html">
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
                                    <h2 class="title mt-2 py-1 text-center">Add new order</h2>
                                    <form class="mt-2 mb-1 px-2" action="" method="post">
                                        <div class="row gap-2">
                                            <?php
                                            $this->formData = [
                                                    "producer" => [
                                                        "element" => SelectField::class,
                                                        "wrapperClass" => "col-8",
                                                        "label" => "Producer name",
                                                        "placeholder" => "Select Producer",
                                                    ],
                                                    "date" => [
                                                        "element" => InputField::class,
                                                        "wrapperClass" => "col-4",
                                                        "label" => "Order Date",
                                                        "placeholder" => "Select order date",
                                                        "type" => "date",
                                                    ],
                                                    "crop_category" => [
                                                        "element" => SelectField::class,
                                                        "wrapperClass" => "col-6",
                                                        "label" => "Category",
                                                        "placeholder" => "Select Category",
                                                    ],
                                                    "crop" => [
                                                        "element" => SelectField::class,
                                                        "wrapperClass" => "col-6",
                                                        "label" => "Crop name",
                                                        "placeholder" => "Select crop",
                                                    ],
                                                    "unit_selling_price" => [
                                                        "element" => InputField::class,
                                                        "wrapperClass" => "col-6",
                                                        "label" => "Unit Price",
                                                        "placeholder" => "Set unit price",
                                                        "type" => "number",
                                                    ],
                                                    "quantity" => [
                                                        "element" => InputField::class,
                                                        "wrapperClass" => "col-6",
                                                        "label" => "Purchased Quantity",
                                                        "placeholder" => "Enter purchased quantity",
                                                        "type" => "number",
                                                    ],
                                            ];
                                            foreach ($this->formData as $key => $value) {
                                                $formField = new $value["element"](
                                                    $key,  //name
                                                    $value["label"],
                                                    $value["placeholder"],
                                                    $this->fields[$key] ?? null,  //value
                                                    $this->fieldErrors[$key] ?? null,
                                                    $value["wrapperClass"]
                                                );
                                                //
                                                isset($this->fieldOptions[$key]) &&
                                                $formField->options = $this->fieldOptions[$key];
                                                //
                                                isset($value["type"]) && $formField->type = $value["type"];
                                                $formField->render();
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (isset($this->error)) { ?>
                                            <br>
                                            <div><?php echo $this->error; ?></div>
                                        <?php } ?>
                                        <div class="mb-3 text-center">
                                            <button class="btn-lg btn-primary-light mt-3 mx-2 text-center text-white"
                                                    type="submit" name="submit_order" value="">Submit
                                            </button>
                                            <button class="btn-lg btn-outlined-error mt-3 mx-2 text-center"
                                                    type="reset" name="cancel_order" value="">Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="<?php echo URL_ROOT ?>/public/js/Manufacturer/manufacturerOrders.js" defer></script>
</body>



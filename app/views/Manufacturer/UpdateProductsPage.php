<?php

use app\views\inc\components\ImageUpload;
use app\views\inc\components\InputField;
use app\views\inc\components\SelectField;
use app\views\inc\components\TextArea;

include APP_ROOT . "/views/inc/components/Header.php";

?>
<?php

//if (isset($this->user)) {
//    echo "Logged in as: " . $this->user->getName() . " (" . $this->user->getRole() . ")<br>";
//    echo "<a href='./logout'>Logout</a>";
//} else {
//    echo "You are not logged in, please <a href='./login'>login</a>";
//}
//


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

            <main class="register container-fluid d-flex align-items-center justify-content-center">
                <div class="wrapper px-4 py-3">
                    <h1 class="title text-center">Update product details</h1>
                    <br>
                    <form class="mt-2 mb-1 px-2" action="" method="post" enctype="multipart/form-data">
                        <div class="row gap-2">
                            <?php
                            $formData = [
                                "category" => [
                                    "element" => SelectField::class,
                                    "wrapperClass" => "col-4",
                                    "label" => "Category",
                                    "placeholder" => "Select Category",
                                ],
                                "product_name" => [
                                    "element" => InputField::class,
                                    "wrapperClass" => "col-8",
                                    "label" => "Product Name",
                                    "placeholder" => "Enter product name",
                                ],
                                "unit" => [
                                    "element" => InputField::class,
                                    "wrapperClass" => "col-6",
                                    "label" => "Unit of measurement",
                                    "placeholder" => "Enter unit of measurement",
                                ],
                                "weight" => [
                                    "element" => InputField::class,
                                    "wrapperClass" => "col-6",
                                    "label" => "Weight (KG)",
                                    "placeholder" => "Enter weight of the product",
                                    "type" => "number step=0.01",
                                ],
                                "unit_price" => [
                                    "element" => InputField::class,
                                    "wrapperClass" => "col-6",
                                    "label" => "Selling Price (per unit)",
                                    "placeholder" => "Enter selling price",
                                    "type" => "number",
                                ],
                                "stock_qty" => [
                                    "element" => InputField::class,
                                    "wrapperClass" => "col-6",
                                    "label" => "Initial Stock Quantity (KG)",
                                    "placeholder" => "Enter initial stock quantity",
                                    "type" => "number",
                                ],
                                "image" => [
                                    "element" => ImageUpload::class,
                                    "wrapperClass" => "col-3",
                                    "label" => "Upload image",
                                    "placeholder" => "",
                                ],
                                "description" => [
                                    "element" => TextArea::class,
                                    "wrapperClass" => "col-9",
                                    "label" => "Description",
                                    "placeholder" => "Add a description",
                                    "row" => 8,
                                ],
                            ];
                            $this->generateFormFields($formData);
                            ?>
                        </div>
                        <?php if (isset($this->error)) { ?>
                            <br>
                            <div class="alert"><?php echo $this->error; ?></div>
                        <?php } ?>
                        <div class="mb-3 text-center">
                            <button class="btn-lg btn-primary-light mt-3 text-center text-white" type="submit"
                                    name="submit_purchase" value="submit">Submit
                            </button>
                            <button class="btn-lg btn-outlined-error mt-3 text-center text-error" type="reset"
                                    name="cancel_purchase" value="cancel">Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </main>
            <?php
            include APP_ROOT . "/views/inc/components/Footer.php";
            ?>

        </main>
    </div>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";


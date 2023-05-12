<?php

use app\views\inc\components\InputField;

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
    <?php
    //include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
    ?>
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
                    <h1 class="title text-center">Add new category</h1>
                    <br>
                    <form class="mb-1 px-2" action="" method="post">
                        <div class="row gap-2">
                            <?php
                            $this->formData = [
                                "name" => [
                                    "element" => InputField::class,
                                    "wrapperClass" => "col-12",
                                    "label" => "Category Name",
                                    "placeholder" => "Enter category name",
                                ],
                                "description" => [
                                    "element" => InputField::class,
                                    "wrapperClass" => "col-12",
                                    "label" => "Description",
                                    "placeholder" => "Add a description",
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

//                                isset($this->fieldOptions[$key]) &&
//                                $formField->options = $this->fieldOptions[$key];
//
//                                isset($value["type"]) && $formField->type = $value["type"];
                                $formField->render();
                            }
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


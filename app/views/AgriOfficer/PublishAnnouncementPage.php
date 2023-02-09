<?php

use app\views\inc\components\InputField;
use app\views\inc\components\TextArea;

include APP_ROOT . "/views/inc/components/Header.php";

?>
<?php

if (!isset($this->user)) {
    echo "You are not logged in, please <a href='./login'>login</a>";
}


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

            <div class="content-wrapper p-1">
                <div class="content p-4">
                    <div class="form-wrapper px-2">
                        <div class="row px-1 pt-1">
                            <div class="col-12 wrapper px-3 py-3">
                                <h2 class="title mt-2 py-1 text-center">Publish announcement</h2>
                                <form class=" mt-2 mb-1 px-2" action="" method="post">

                                    <div class="row gap-2">
                                        <?php
                                        $this->formData = [
                                            "Announcement Title" => [
                                                "element" => InputField::class,
                                                "wrapperClass" => "col-12",
                                                "label" => "<b>Announcement Title</b>",
                                                "placeholder" => "Enter the announcement title",
                                                "type" => "text"
                                            ],
                                            "Announcement Content" => [
                                                "element" => TextArea::class,
                                                "wrapperClass" => "col-12",
                                                "label" => "<b>Announcement Content</b>",
                                                "placeholder" => "Enter announcement content",
                                                "rows" => 4,
                                                "cols" => 12
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
                                            isset($value["rows"]) && $formField->rows = $value["rows"];
                                            isset($value["cols"]) && $formField->cols = $value["cols"];

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

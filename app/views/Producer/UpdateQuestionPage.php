<?php

use app\views\inc\components\ImageUpload;
use app\views\inc\components\InputField;
use app\views\inc\components\TextArea;

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
                                <h2 class="title mt-2 py-1 text-left">Update question</h2>
                                <form class="mt-2 mb-1 px-2" action="" method="post" enctype="multipart/form-data">
                                    <div class="row gap-2">
                                        <?php
                                        $formData = [
                                            "title" => [
                                                "element" => InputField::class,
                                                "wrapperClass" => "col-12",
                                                "label" => "Question title",
                                                "placeholder" => "Enter question title",
                                            ],
                                            "image" => [
                                                "element" => ImageUpload::class,
                                                "wrapperClass" => "col-3",
                                                "label" => "Upload image",
                                                "placeholder" => "",
                                            ],
                                            "content" => [
                                                "element" => TextArea::class,
                                                "wrapperClass" => "col-9",
                                                "label" => "Question content",
                                                "placeholder" => "Enter question content",
                                                "rows" => 8,
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

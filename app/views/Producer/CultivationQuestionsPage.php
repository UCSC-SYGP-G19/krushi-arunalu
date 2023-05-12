<?php
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
                        <div class="row px-1 pt-1 justify-content-space-between">
                            <div class="col-6">
                                <h1 class="title">Cultivation Questions</h1>
                            </div>
                            <div class="col">
                                <a href="cultivation-questions/ask"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Ask question</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php";
                                ?>
                            </div>
                        </div>
                        <section class="px-1">
                            <?php foreach ($this->data as $question) {
                                ?>
                                <div class="question-wrapper py-3 px-4 mb-3">
                                    <div class="row justify-content-space-between">
                                        <div class="col-8">
                                            <a href="<?php echo('cultivation-questions/details/' . $question->id) ?>">
                                                <h3 class="question-title">
                                                    <?php echo $question->title; ?>
                                                </h3>
                                            </a>
                                        </div>
                                        <div class="col-2 question-actions text-right">
                                            <a class="btn-xs btn-outlined-secondary mr-1 px-2 fs-3"
                                               href="<?php echo('cultivation-questions/edit/' . $question->id) ?>">
                                                Edit
                                            </a>

                                            <a class="btn-xs btn-outlined-error ml-1 px-2 fs-3"
                                               href="<?php echo('cultivation-questions/delete/' . $question->id) ?>">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-1">
                                            <span class="text-primary-light fw-bold">
                                                <?php echo $question->producer_name; ?>
                                            </span>
                                            <span class="text-secondary"> - asked on
                                                <?php echo $question->asked_date_time; ?></span>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end response-info">
                                        <div class="col mb-1">
                                            <span class="response-status mx-2">Responded ✓️</span>
                                            <span class="text-secondary">&nbsp;Last response on</span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </section>
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


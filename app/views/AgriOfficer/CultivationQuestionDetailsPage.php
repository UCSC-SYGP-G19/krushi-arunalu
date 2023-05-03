<?php

use app\helpers\Session;

include APP_ROOT . "/views/inc/components/Header.php";
?>
    <body class="overflow-hidden full-height">
    <div class="content-with-sidebar">
        <?php
        include APP_ROOT . "/views/inc/components/Sidebar.php"
        ?>
        <main class="content overflow-y-auto">
            <?php
            include APP_ROOT . "/views/inc/components/LoggedInNavbar.php";
            $questionData = $this->data["questionDetails"];
            $responses = $this->data["questionResponses"];
            ?>
            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 mb-2">
                            <div class="col-6">
                                <a href="<?php echo(URL_ROOT . "/cultivation-questions") ?>"
                                   class="btn-sm btn-outlined-primary-light text-center">
                                    <svg class="mr-1" width="8" height="12" viewBox="0 0 8 14" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                    <span class="">Back to all questions</span></a>
                            </div>
                        </div>
                        <div class="px-1 mt-3">
                            <!--                            Question details-->
                            <section class="question-details-wrapper pt-2 pb-2 px-4 mb-3">
                                <div class="row px-1 pt-1 heading">
                                    <div class="col-10 py-2 d-inline-flex">
                                        <div class="user-avatar mr-2">
                                            <img width="50px"
                                                 src="<?php echo(URL_ROOT .
                                                     "/public/img/icons/navbar/user-avatar.webp"); ?>"
                                                 alt="avatar">
                                        </div>
                                        <div class="user-info ml-2 pb-1">
                                            <h3>
                                                <?php echo $questionData->producer_name;
                                                ?>
                                            </h3>
                                            <span class="text-secondary">asked on
                                                    <?php echo $questionData->asked_date_time; ?></span>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-2 question-actions text-right">-->
                                    <!--                                        <a class="btn-xs btn-outlined-secondary mr-1 px-2 fs-3"-->
                                    <!--                                           href="-->
                                    <?php //echo(URL_ROOT . "/cultivation-questions/response/" . $questionData->id) ?><!--">-->
                                    <!--                                            Add a response-->
                                    <!--                                        </a>-->
                                    <!--                                    </div>-->
                                    <div class="col-2 justify-content-center text-right">
                                        <div class="badge badge-warning fs-3 mt-2">0 responses</div>

                                    </div>
                                </div>
                                <hr class="mx-1">
                                <div class="row pt-2 pb-1 px-1 justify-content-center body">
                                    <div class="col-12 py-1">
                                        <h2 class="question-title pt-2">
                                            <?php echo $questionData->title; ?>
                                        </h2>
                                    </div>
                                    <div class="col-12 py-2 mb-2">
                                        <p class="question-content">
                                            <?php echo $questionData->content; ?>
                                        </p>
                                    </div>
                                    <?php if ($questionData->image != null) { ?>
                                        <div class="col-8 py-1 my-2">
                                            <img class="question-image" src="<?php echo(URL_ROOT .
                                                "/public/uploads/cultivation-questions/" .
                                                $questionData->image); ?>"
                                                 alt="question image">
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                            <div class="pt-2 pb-3">
                                <h3 class="text-light-green">Responses</h3>
                            </div>
                            <!-- Responses list-->
                            <?php if (!empty($responses)) {
                                foreach ($responses as $response) {
                                    ?>
                                    <section class="question-details-wrapper pt-2 pb-2 px-4 mb-3">
                                        <div class="row px-1 pt-1 heading">
                                            <div class="col-10 py-2 d-inline-flex">
                                                <div class="user-avatar mr-2">
                                                    <img width="50px"
                                                         src="<?php echo(URL_ROOT .
                                                             "/public/img/icons/navbar/user-avatar.webp"); ?>"
                                                         alt="avatar">
                                                </div>
                                                <div class="user-info ml-2 pb-1">
                                                    <h3>
                                                        <?php echo $response->agri_officer_name; ?>
                                                    </h3>
                                                    <span class="text-secondary">responded on
                                                    <?php echo $response->responded_date_time; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-1 px-1 justify-content-center body">
                                            <div class="col-12 mb-2">
                                                <p id="myParagraph" class="question-content">
                                                    <?php echo $response->response_content;
                                                    //print_r($response) ?>

                                                </p>
                                            </div>
                                        </div>

                                        <?php if ($response->agri_officer_id == Session::getSession()->id) { ?>
                                        <div class="text-right">
                                            <button onclick="editResponse('<?php echo($response->response_content); ?>')"
                                                    class="btn-xs btn-outlined-primary-dark text-center">
                                                Edit
                                            </button>
                                            '
                                            <a href='<?php echo(URL_ROOT) ?>/cultivation-questions/deleteResponse/
                                            <?php echo($response->response_id); ?>'
                                               class="btn-xs btn-outlined-error-dark text-center">Delete</a>
                                        <?php } ?>
                                        </div>
                                    </section>

                                    <?php
                                }
                            } else {
                                echo '<h4>No Respons to Display</h4>';
                            }
                            ?>

                            <form method="post" action="../respond/<?php echo($questionData->id); ?>">
                                <div class="row pt-1 align-items-center justify-content-end gap-1 pl-3 pr-2">
                                    <div class="col-1 text-center">
                                        <img class="user-profile-pic"
                                             src="<?php echo(URL_ROOT . "/public/img/icons/navbar/user-avatar.webp"); ?>"
                                             alt="avatar" width="70%">
                                    </div>
                                    <div class="col-10 py-2">
                                        <textarea id="response-input" name="response-input" class="col-12"
                                        ></textarea>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn-sm btn-primary-light mb-1 text-white" type="submit">Send
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div>

                <?php
                include APP_ROOT . "/views/inc/components/Footer.php";
                ?>
        </main>
    </div>
    <script src="<?php echo URL_ROOT ?>/public/js/AgriOfficer/cultivationQuestionResponse.JS" defer></script>
    </body>

<?php
include APP_ROOT . " / views / inc / components / EndingTag . php";


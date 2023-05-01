<?php

include APP_ROOT . "/views/inc/components/Header.php";

?>
    <body class="overflow-hidden full-height">
    <div class="content-with-sidebar">
        <main class="content overflow-y-auto">
            <?php
            include APP_ROOT . "/views/inc/components/LoggedInNavbarWithoutSidebar.php"
            ?>
            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">

                        <div class="d-flex align-items-center justify-content-center">
                            <div class="row chat-page">

                                <!--Upper Part-->
                                <div class="col-12 header-row d-flex">
                                    <div class="chat-title-wrapper col-3">
                                        <div class="py-2 pl-3 justify-content-space-between">
                                            <h2 class="chat-title">Chats</h2>
                                        </div>
                                    </div>

                                    <!--                                Chat Header-->
                                    <div class="chat-header col-9 row py-1 px-1 d-flex" id="chat-header">
                                    </div>
                                </div>

                                <!--                            Bottom Part-->
                                <div class="col-12 d-flex bottom-row">
                                    <!--                                Chat List-->
                                    <div class="col-3">
                                        <div class="search-bar p-2" id="search-bar">
                                        </div>
                                        <div class="chat-list" id="chat-list">
                                        </div>
                                    </div>

                                    <div class="chat-background col-9" id="chat-background">
                                        <div class="chat px-3 py-2" id="chat">
                                            <div class="align-items-center justify-content-center d-flex min-h-100">
                                                <?php echo '<img alt="Background Image" class="chat-bg-image"
                                                src="' . URL_ROOT . '/public/img/other/chat.gif">' ?>
                                            </div>
                                        </div>
                                        <!--                                    MessageBox-->
                                        <div class="message-input-box px-3 py-2 d-flex" id="message-box">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--            --><?php
            //            include APP_ROOT . "/views/inc/components/Footer.php";
            //            ?>
        </main>

    </div>
    <script src="<?php echo URL_ROOT ?>/public/js/chat.js" defer></script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";

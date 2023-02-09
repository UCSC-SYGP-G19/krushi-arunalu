<?php
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

            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row px-1 pt-1 justify-content-space-between">
                            <div class="col-6">
                                <h1 class="title">Announcements</h1>
                            </div>
                            <div class="col">
                                <a href="announcements/publish" class="btn-md btn-primary-light text-center text-white">
                                    Publish announcements</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <?php
                                include APP_ROOT . "/views/inc/components/SearchFilterAndSort.php"
                                ?>

                            </div>

                            <?php
                            if (count($this->data) > 0) {
                                foreach ($this->data as $row) {
                                    echo '<div class="col-12 form-wrapper p-4 mb-3">
                                <h3>' . $row->announcement_title . '</h3>
                                <p class="pt-2 text-justify">' . $row->announcement_content
                                        . '
                                </p>
                                <div class="text-right pt-2">
                                    <b class="text-primary-dark">' . $row->agri_officer_name . '</b>
                                - ' . $row->announcement_published_date_time . '
                                </div>
                            </div>';
                                }
                            } else {
                                echo '<div class="m-4"><h5>No announcements yet</h5></div>';
                            }
                            ?>
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


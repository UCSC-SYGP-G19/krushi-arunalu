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
                                <h1 class="title">Agri Officers</h1>
                            </div>
                            <div class="col">
                                <a href="<?php echo URL_ROOT ?>/UserManagement/addAgriOfficer"
                                   class="btn-md btn-primary-light text-center text-white">
                                    Add Agri Officer</a>
                            </div>
                        </div>
                        <div class="row px-1 pt-2">
                            <div class="col-12 text-justify">
                                <br>
                                <table>
                                    <thead>
                                    <tr class="row">
                                        <th class="col-2">NIC</th>
                                        <th class="col-3">Name</th>
                                        <th class="col-2">Contact no</th>
                                        <th class="col-3">Email</th>
                                        <th class="col-2"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($this->data as $row) { ?>
                                        <tr class="row">
                                            <td class="col-2"><?php echo $row->nic; ?></td>
                                            <td class="col-3"><?php echo $row->name; ?></td>
                                            <td class="col-2"><?php echo $row->contact_no; ?></td>
                                            <td class="col-3"><?php echo $row->email; ?></td>
                                            <td class="col-2 pr-3">
                                                <div class="row align-items-center justify-content-center gap-1">
                                                    <a href=''
                                                       class="btn-xs btn-outlined-primary-dark text-center">
                                                        View Details
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
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


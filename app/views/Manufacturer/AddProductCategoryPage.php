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
                    <h1 class="title">Add new category</h1>
                    <br>
                    <form class="mb-1 px-2" action="" method="post">
                        <div class="row gap-2">
                            <div class="col-12">
                                <label for="category-name">Category Name</label>
                                <input type="text" id="category-name" name="category-name"
                                       placeholder="Enter category name"
                                       value="<?php
                                        if (isset($this->fields['category-name'])) {
                                            echo $this->fields['category-name'];
                                        }
                                        ?>">
                                <?php if (isset($this->fieldErrors['category-name'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['category-name']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row gap-2">
                            <div class="col-12">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="5"
                                          placeholder="Add a description"
                                          value="<?php
                                            if (isset($this->fields['description'])) {
                                                echo $this->fields['description'];
                                            }
                                            ?>"></textarea>
                                <?php if (isset($this->fieldErrors['description'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['description']; ?></div>
                                <?php } ?>
                            </div>
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


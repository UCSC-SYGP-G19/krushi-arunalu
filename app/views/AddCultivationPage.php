<?php
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

            <div class="content-wrapper min-h-100 p-1">
                <div class="content p-4">
                    <div class="form-wrapper px-2">
                        <div class="row px-1 pt-1">
                            <div class="col-12 wrapper px-3 py-3">
                                <h2 class="title mt-2 py-1 text-center">Add new cultivation</h2>
                                <form class=" mt-2 mb-1 px-2" action="" method="post">
                                    <h3 class="form-section-title">Details of cultivation</h3>
                                    <div class="row gap-2">
                                        <div class="col-4">
                                            <label for="land">Land</label>
                                            <select name="land" id="land">
                                                <option value="" selected>Select land</option>
                                                <?php foreach ($this->fieldOptions["lands"] as $option) {
                                                    echo '<option value="' . $option->getId() . '"' .
                                                        ($this->fields['land'] == $option->getId() ? 'selected' : '')
                                                        . '>' . $option->getName() . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <?php if (isset($this->fieldErrors['land'])) { ?>
                                                <div class="error"><?php echo $this->fieldErrors['land']; ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-8">
                                            <label for="crop">Crop name</label>
                                            <select name="crop" id="crop">
                                                <option value="" selected>Select crop</option>
                                                <?php foreach ($this->fieldOptions["crops"] as $option) {
                                                    echo '<option value="' . $option->getId() . '"' .
                                                        ($this->fields['crop'] == $option->getId() ? 'selected' : '')
                                                        . '>' . $option->getName() . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <?php if (isset($this->fieldErrors['crop'])) { ?>
                                                <div class="error"><?php echo $this->fieldErrors['crop']; ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-4">
                                            <label for="cultivated_quantity">Cultivated quantity</label>
                                            <input type="number" id="cultivated_quantity" name="cultivated_quantity"
                                                   placeholder="Enter cultivated quantity (KG)"
                                                   value="<?php
                                                    if (isset($this->fields['cultivated_quantity'])) {
                                                        echo $this->fields['cultivated_quantity'];
                                                    }
                                                    ?>">
                                            <?php if (isset($this->fieldErrors['cultivated_quantity'])) { ?>
                                                <div class="error"><?php
                                                    echo $this->fieldErrors['cultivated_quantity']; ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-4">
                                            <label for="cultivated_date">Cultivated date</label>
                                            <input type="date" id="cultivated_date" name="cultivated_date"
                                                   placeholder="Enter cultivated date"
                                                   value="<?php
                                                    if (isset($this->fields['cultivated_date'])) {
                                                        echo $this->fields['cultivated_date'];
                                                    }
                                                    ?>">
                                            <?php if (isset($this->fieldErrors['cultivated_date'])) { ?>
                                                <div class="error"><?php
                                                    echo $this->fieldErrors['cultivated_date']; ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-4">
                                            <label for="expected_harvest_date">Expected harvest date</label>
                                            <input type="date" id="expected_harvest_date" name="expected_harvest_date"
                                                   placeholder="Enter expected harvest date"
                                                   value="<?php
                                                    if (isset($this->fields['expected_harvest_date'])) {
                                                        echo $this->fields['expected_harvest_date'];
                                                    }
                                                    ?>">
                                            <?php if (isset($this->fieldErrors['expected_harvest_date'])) { ?>
                                                <div class="error"><?php
                                                    echo $this->fieldErrors['expected_harvest_date']; ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <label for="status">Status</label>
                                            <input type="text" id="status" name="status"
                                                   placeholder="Enter status of cultivation"
                                                   value="<?php
                                                    if (isset($this->fields['status'])) {
                                                        echo $this->fields['status'];
                                                    }
                                                    ?>">
                                            <?php if (isset($this->fieldErrors['status'])) { ?>
                                                <div class="error"><?php
                                                    echo $this->fieldErrors['status']; ?></div>
                                            <?php } ?>
                                        </div>
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


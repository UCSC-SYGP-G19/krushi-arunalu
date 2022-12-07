<?php
include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto">
<?php
include APP_ROOT . "/views/inc/components/LoggedInNavbarWithoutSidebar.php"
?>
<main class="register container-fluid d-flex align-items-center justify-content-center">
    <div class="wrapper px-4 py-3">
        <h2 class="title mt-2 py-1 text-center">Enter Land and Cultivation details</h2>
        <h3 class="text-center text-secondary fs-3">Please enter the following details in order to start
            using the system</h3>
        <h4 class="text-right text-primary-dark fs-3 fw-bold pt-2 px-2">Page 2 of 2</h4>
        <br>
        <form class="mb-1 px-2" action="" method="post">
            <h3 class="form-section-title">Details of your existing cultivations</h3>
            <div class="row gap-2">
                <div class="col-4">
                    <label for="land">Land</label>
                    <select name="land" id="land">
                        <option value="" selected>Select land</option>
                        <?php foreach ($this->fieldOptions["land"] as $option) {
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
                    <label for="crop">Crop</label>
                    <select name="crop" id="crop">
                        <option value="" selected>Select crop</option>
                        <?php foreach ($this->fieldOptions["crop"] as $option) {
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
            </div>
            <!--            <div class="row gap-2">-->
            <!--                <div class="col-4">-->
            <!--                    <label for="crop_category">Crop category</label>-->
            <!--                    <select name="crop_category" id="crop_category">-->
            <!--                        <option value="" selected>Select crop category</option>-->
            <!--                        --><?php //foreach ($this->fieldOptions["crop_category"] as $option) {
            //                            echo '<option value="' . $option->getId() . '"' .
            //                                ($this->fields['crop_category'] == $option->getId() ? 'selected' : '')
            //                                . '>' . $option->getName() . '</option>';
            //                        }
            //                        ?>
            <!--                    </select>-->
            <!--                </div>-->
            <!--                <div class="col-8">-->
            <!--                    <label for="crop-name">Crop name</label>-->
            <!--                    <input type="text" id="crop-name" name="crop-name"-->
            <!--                           placeholder="Enter crop name"-->
            <!--                           value="--><?php
            //                            if (isset($this->fields['crop-name'])) {
            //                                echo $this->fields['crop-name'];
            //                            }
            //                            ?><!--">-->
            <!--                    --><?php //if (isset($this->fieldErrors['crop-name'])) { ?>
            <!--                        <div class="error">-->
            <?php //echo $this->fieldErrors['crop-name']; ?><!--</div>-->
            <!--                    --><?php //} ?>
            <!--                </div>-->
            <!--            </div>-->
            <div class="row gap-2">
                <div class="col-4">
                    <label for="cultivated_quantity">Cultivated quantity</label>
                    <input type="number" id="cultivated_quantity" name="cultivated_quantity"
                           placeholder="Enter quantity"
                           value="<?php
                            if (isset($this->fields['cultivated_quantity'])) {
                                echo $this->fields['cultivated_quantity'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['cultivated_quantity'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['cultivated_quantity']; ?></div>
                    <?php } ?>
                </div>
                <div class="col-4">
                    <label for="cultivated_date">Cultivated date</label>
                    <input type="date" id="cultivated_date" name="cultivated_date"
                           placeholder="Select date"
                           value="<?php
                            if (isset($this->fields['cultivated_date'])) {
                                echo $this->fields['cultivated_date'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['cultivated_date'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['cultivated_date']; ?></div>
                    <?php } ?>
                </div>
                <div class="col-4">
                    <label for="expected_harvest_date">Expected harvest date</label>
                    <input type="date" id="expected_harvest_date" name="expected_harvest_date"
                           placeholder="Select date"
                           value="<?php
                            if (isset($this->fields['expected_harvest_date'])) {
                                echo $this->fields['expected_harvest_date'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['expected_harvest_date'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['expected_harvest_date']; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="row gap-2">
                <div class="col-12">
                    <label for="status">Status</label>
                    <input type="text" id="status" name="status"
                           placeholder="Enter status"
                           value="<?php
                            if (isset($this->fields['status'])) {
                                echo $this->fields['status'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['status'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['status']; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn-sm btn-outlined-primary-light mt-3 mb-1 text-center" type="button"
                            name="add_land" value="add_land">Add more cultivations
                    </button>
                </div>
            </div>
            <?php if (isset($this->error)) { ?>
                <br>
                <div class="alert"><?php echo $this->error; ?></div>
            <?php } ?>
            <div class="mb-3 text-center">
                <button class="btn-lg btn-primary-light mt-3 text-center text-white" type="submit" name="submit_page_1"
                        value="register">Next
                </button>
            </div>
        </form>
    </div>
</main>
</body>
<?php
include APP_ROOT . "/views/inc/components/Footer.php"
?>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";
?>

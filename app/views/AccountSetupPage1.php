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
        <h4 class="text-right text-primary-dark fs-3 fw-bold pt-2 px-2">Page 1 of 2</h4>
        <br>
        <form class="mb-1 px-2" action="" method="post">
            <h3 class="form-section-title">Details of your lands</h3>
            <div class="row gap-2">
                <div class="col-4">
                    <label for="land_name">Land name</label>
                    <input type="text" id="land_name" name="land_name" placeholder="Enter a name to identify land"
                           value="<?php
                            if (isset($this->fields['land_name'])) {
                                echo $this->fields['land_name'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['land_name'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['land_name']; ?></div>
                    <?php } ?>
                </div>
                <div class="col-4">
                    <label for="land_size">Land size (area)</label>
                    <input type="number" id="land_size" name="land_size"
                           placeholder="Enter land size (area) in hectares"
                           value="<?php
                            if (isset($this->fields['land_size'])) {
                                echo $this->fields['land_size'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['land_size'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['land_size']; ?></div>
                    <?php } ?>
                </div>
                <div class="col-4">
                    <label for="district">District</label>
                    <select name="district" id="district">
                        <option value="" selected>Select district</option>
                        <?php foreach ($this->fieldOptions["district"] as $option) {
                            echo '<option value="' . $option->getId() . '"' .
                                ($this->fields['district'] == $option->getId() ? 'selected' : '')
                                . '>' . $option->getName() . '</option>';
                        }
                        ?>
                    </select>
                    <?php if (isset($this->fieldErrors['district'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['district']; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="row gap-2">
                <div class="col-12">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address"
                           placeholder="Enter land address"
                           value="<?php
                            if (isset($this->fields['address'])) {
                                echo $this->fields['address'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['address'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['address']; ?></div>
                    <?php } ?>
                </div>
            </div>
            <h3 class="form-section-title">Land condition</h3>
            <div class="row gap-2">
                <div class="col-4">
                    <label for="soil_condition">Soil condition</label>
                    <select name="soil_condition" id="soil_condition">
                        <option value="" selected>Select soil condition</option>
                        <option value="Dry" <?php
                        if (isset($this->fields['soil_condition']) && $this->fields['soil_condition'] == 'Dry') {
                            echo 'selected';
                        }
                        ?>>Dry
                        </option>
                        <option value="Normal" <?php
                        if (isset($this->fields['soil_condition']) && $this->fields['soil_condition'] == 'Normal') {
                            echo 'selected';
                        }
                        ?>>Normal
                        </option>
                        <option value="Muddy" <?php
                        if (isset($this->fields['soil_condition']) && $this->fields['soil_condition'] == 'Muddy') {
                            echo 'selected';
                        }
                        ?>>Muddy
                        </option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="rainfall">Rainfall</label>
                    <select name="rainfall" id="rainfall">
                        <option value="" selected>Select amount of rainfall</option>
                        <option value="Low" <?php
                        if (isset($this->fields['rainfall']) && $this->fields['rainfall'] == 'Low') {
                            echo 'selected';
                        }
                        ?>>Low
                        </option>
                        <option value="Medium" <?php
                        if (isset($this->fields['rainfall']) && $this->fields['rainfall'] == 'Medium') {
                            echo 'selected';
                        }
                        ?>>Medium
                        </option>
                        <option value="High" <?php
                        if (isset($this->fields['rainfall']) && $this->fields['rainfall'] == 'High') {
                            echo 'selected';
                        }
                        ?>>High
                        </option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="humidity">Humidity</label>
                    <select name="humidity" id="humidity">
                        <option value="" selected>Select level of humidity</option>
                        <option value="Low" <?php
                        if (isset($this->fields['humidity']) && $this->fields['humidity'] == 'Low') {
                            echo 'selected';
                        }
                        ?>>Low
                        </option>
                        <option value="Medium" <?php
                        if (isset($this->fields['humidity']) && $this->fields['humidity'] == 'Medium') {
                            echo 'selected';
                        }
                        ?>>Medium
                        </option>
                        <option value="High" <?php
                        if (isset($this->fields['humidity']) && $this->fields['humidity'] == 'High') {
                            echo 'selected';
                        }
                        ?>>High
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn-sm btn-outlined-primary-light mt-3 mb-1 text-center" type="button"
                            name="add_land" value="add_land">Add more lands
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

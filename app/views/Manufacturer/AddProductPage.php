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
                    <h1 class="title">Add new product</h1>
                    <br>
                    <form class="mb-1 px-2" action="" method="post">
                        <div class="row gap-2">
                            <div class="col-4">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id">
                                    <option value="" selected>Select category</option>
                                    <?php foreach ($this->fieldOptions["product_category"] as $option) {
                                        echo '<option value="' . $option->getId() . '"' .
                                            ($this->fields['category_id'] == $option->getId() ? 'selected' : '')
                                            . '>' . $option->getName() . '</option>';
                                    }
                                    ?>
                                </select>
                                <?php if (isset($this->fieldErrors['category_id'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['category_id']; ?></div>
                                <?php } ?>
                            </div>
                            <div class="col-8">
                                <label for="product_name">Product Name</label>
                                <input type="text" id="product_name" name="product_name"
                                       placeholder="Enter product name"
                                       value="<?php
                                        if (isset($this->fields['product_name'])) {
                                            echo $this->fields['product_name'];
                                        }
                                        ?>">
                                <?php if (isset($this->fieldErrors['product_name'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['product_name']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row gap-2">
                            <div class="col-6">
                                <label for="unit">Unit of measurement</label>
                                <input type="text" id="unit" name="unit"
                                       placeholder="Enter unit of measurement"
                                       value="<?php
                                        if (isset($this->fields['unit'])) {
                                            echo $this->fields['unit'];
                                        }
                                        ?>">
                                <?php if (isset($this->fieldErrors['unit'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['unit']; ?></div>
                                <?php } ?>
                            </div>
                            <div class="col-6">
                                <label for="weight">Weight</label>
                                <input type="text" id="weight" name="weight"
                                       placeholder="Enter weight of the product"
                                       value="<?php
                                        if (isset($this->fields['weight'])) {
                                            echo $this->fields['weight'];
                                        }
                                        ?>">
                                <?php if (isset($this->fieldErrors['weight'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['weight']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row gap-2">
                            <div class="col-6">
                                <label for="unit_price">Selling price(per unit)</label>
                                <input type="text" id="unit_price" name="unit_price"
                                       placeholder="Enter selling price"
                                       value="<?php
                                        if (isset($this->fields['unit_price'])) {
                                            echo $this->fields['unit_price'];
                                        }
                                        ?>">
                                <?php if (isset($this->fieldErrors['unit_price'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['unit_price']; ?></div>
                                <?php } ?>
                            </div>
                            <div class="col-6">
                                <label for="stock_qty">Initial stock quantity</label>
                                <input type="text" id="stock_qty" name="stock_qty"
                                       placeholder="Enter initial stock quantity"
                                       value="<?php
                                        if (isset($this->fields['stock_qty'])) {
                                            echo $this->fields['stock_qty'];
                                        }
                                        ?>">
                                <?php if (isset($this->fieldErrors['stock_qty'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['stock_qty']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row gap-2">
                            <div class="col-12">
                                <label for="image_url">Image URL</label>
                                <input type="text" id="image_url" name="image_url"
                                       placeholder="Enter image URL"
                                       value="<?php
                                        if (isset($this->fields['image_url'])) {
                                            echo $this->fields['image_url'];
                                        }
                                        ?>">
                                <?php if (isset($this->fieldErrors['image_url'])) { ?>
                                    <div class="error"><?php echo $this->fieldErrors['image_url']; ?></div>
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


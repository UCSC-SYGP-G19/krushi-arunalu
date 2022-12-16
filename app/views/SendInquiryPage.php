<?php
include APP_ROOT . "/views/inc/components/Header.php"
?>
<body class="overflow-auto">
<?php
include APP_ROOT . "/views/inc/components/LoggedOutNavbar.php"
?>
<main class="register container-fluid d-flex align-items-center justify-content-center">
    <div class="wrapper px-4 py-3 mt-5">
        <h1 class="title mt-2 py-1 text-center">Send Product Inquiry</h1>
        <br>
        <form class="mb-1 px-2" action="" method="post">

            <div class="row gap-2">
                <!--                <div class="col-6">-->
                <!--                    <label for="name">Product</label>-->
                <!--                    <input type="text" id="name" name="product" placeholder="Enter product"-->
                <!--                           value="--><?php
                //                            if (isset($this->fields['name'])) {
                //                                echo $this->fields['name'];
                //                            }
                //                            ?><!--">-->
                <!--                    --><?php //if (isset($this->fieldErrors['name'])) { ?>
                <!--                        <div class="error">-->
                <?php //echo $this->fieldErrors['name']; ?><!--</div>-->
                <!--                    --><?php //} ?>
                <!--                </div>-->

            </div>
            <div class="row gap-2">
                <div class="col-9">
                    <label for="address">Your Inquiry</label>
                    <input type="text" id="query" name="content"
                           placeholder="Enter your query regarding the product"
                           value="<?php
                            if (isset($this->fields['query'])) {
                                echo $this->fields['query'];
                            }
                            ?>">
                    <?php if (isset($this->fieldErrors['query'])) { ?>
                        <div class="error"><?php echo $this->fieldErrors['query']; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div>
                <button class="btn-primary-light mt-3 text-center text-white" type="submit" name="login"
                        value="login">Submit
                </button>
                <button class="btn-primary-light mt-3 text-center text-white" type="reset" name="cancel"
                        value="cancel">cancel
                </button>
            </div>

            <div class="row gap-2">

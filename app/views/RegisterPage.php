<?php
include APP_ROOT . "/views/inc/components/header.php"
?>
    <body>
    <h2>Register</h2>
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        <br>
        <br>
        <label for="address">Address</label>
        <input type="text" id="address" name="address">
        <br>
        <br>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <br>
        <br>
        <label for="contact_no">Contact no:</label>
        <input type="text" id="contact_no" name="contact_no">
        <br>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <br>
        <?php if (isset($this->error)) { ?>
            <p class="error"><?php echo $this->error; ?></p>
        <?php } ?>
        <br>
        <button type="submit" name="register">Register</button>
        <br>
        <h5>Already have an account? <a href="./login">Login</a></h5>
    </form>
    </body>
<?php
include APP_ROOT . "/views/inc/components/footer.php"
?>
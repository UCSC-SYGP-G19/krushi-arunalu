<?php
include APP_ROOT . "/views/inc/components/header.php"
?>
    <body>
    <h2>Login</h2>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <?php if (isset($this->fieldErrors['email'])) { ?>
            <p class="error"><?php echo $this->fieldErrors['email']; ?></p>
        <?php } ?>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <?php if (isset($this->fieldErrors['password'])) { ?>
            <p class="error"><?php echo $this->fieldErrors['password']; ?></p>
        <?php } ?>
        <?php if (isset($this->error)) { ?>
            <p class="error"><?php echo $this->error; ?></p>
        <?php } ?>
        <br>
        <br>
        <button type="submit" name="login">Login</button>
        <br>
        <h5>No account? <a href="./register">Register</a></h5>
    </form>
    </body>
<?php
include APP_ROOT . "/views/inc/components/footer.php"
?>
<?php
include APP_ROOT . "/views/inc/components/header.php"
?>
    <body class="overflow-hidden">
    <?php
    include APP_ROOT . "/views/inc/components/loggedOutNavbar.php"
    ?>
    <main class="login row d-flex align-items-center justify-content-center">
        <div class="wrapper px-4 py-3 mt-5">
            <h1 class="title pt-2 text-center">Login</h1>
            <br>
            <form class="mb-1" action="" method="post">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter your email">
                <?php if (isset($this->fieldErrors['email'])) { ?>
                    <div class="error"><?php echo $this->fieldErrors['email']; ?></div>
                <?php } ?>
                <br>
                <label for="password" class="mt-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <?php if (isset($this->fieldErrors['password'])) { ?>
                    <div class="error"><?php echo $this->fieldErrors['password']; ?></div>
                <?php } ?>
                <?php if (isset($this->error)) { ?>
                    <div class="alert"><?php echo $this->error; ?></div>
                <?php } ?>
                <div class="mt-2 mb-3 text-center">
                    <p class="pt-1 pb-2">No account?&nbsp;
                        <a href="./register" class="text-light-green">Register now</a>
                    </p>
                    <button class="btn-primary-light mt-3 text-center text-white" type="submit" name="login">LOGIN
                    </button>
                </div>
            </form>
        </div>
    </main>
    </body>
<?php
include APP_ROOT . "/views/inc/components/footer.php"
?>
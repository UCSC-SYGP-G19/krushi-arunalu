<?php
include APP_ROOT . "/views/inc/components/header.php"
?>
<?php

if (isset($this->user)) {
    echo "Logged in as: " . $this->user->getName() . " (" . $this->user->getRole() . ")<br>";
    echo "<a href='./logout'>Logout</a>";
} else {
    echo "You are not logged in, please <a href='./login'>login</a>";
}
?>
<?php
include APP_ROOT . "/views/inc/components/footer.php";
